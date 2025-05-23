<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnComments extends OssnAnnotation {
		/**
		 * Get a comment type from object
		 *
		 * @return string
		 */
		public static function getType($object) {
				$type = array(
						'comments:post'   => 'post', // <- this is actually object
						'comments:entity' => 'entity',
						'comments:object' => 'object',
				);
				return $type[$object];
		}

		/**
		 * Post Comment
		 *
		 * @param integer $subject_id Id of item on which user comment
		 * @param integer $guid User id
		 * @param string $comment Comment
		 * @param string $type Post or Entity
		 *
		 * @return boolean|integer
		 */
		public function PostComment($subject_id, $guid, $comment, $type = 'post') {
				if(empty($subject_id) || empty($guid)) {
						return false;
				}
				//[B]comment is added if the post/entity has been deleted already #1645
				//renewed for objects also
				if($type == 'post' || $type == 'object') {
						$postc = ossn_get_object($subject_id);
						if(!$postc) {
								return false;
						}
						ossn_trigger_callback('comment', 'before:created', array(
								'type'   => $type,
								'object' => $postc,
						));
				}

				if($type == 'entity') {
						$entityc = ossn_get_entity($subject_id);
						if(!$entityc) {
								return false;
						}
						ossn_trigger_callback('comment', 'before:created', array(
								'type'   => 'entity',
								'entity' => $entityc,
						));
				}

				$cancomment = false;
				if(strlen($comment)) {
						$cancomment = true;
				}
				if(!empty($this->comment_image)) {
						$cancomment = true;
				}
				$this->subject_guid = $subject_id;
				$this->owner_guid   = $guid;
				$this->type         = "comments:{$type}";
				$this->value        = $comment;
				if($cancomment && $this->addAnnotation()) {
						if(isset($this->comment_image)) {
								$image                = base64_decode($this->comment_image);
								$file                 = ossn_string_decrypt(base64_decode($image));
								$file_path            = rtrim(ossn_validate_filepath($file), '/');
								$full_path            = ossn_get_userdata("tmp/photos/{$file_path}");
								//[B] Comment Static photo should have only filename no fullpath #2090
								$_FILES['attachment'] = array(
										'name'     => $file_path,
										'tmp_name' => $full_path,
										'type'     => 'image/jpeg',
										'size'     => filesize($full_path),
										'error'    => UPLOAD_ERR_OK,
								);
								$file          = new OssnFile();
								$file->type    = 'annotation';
								$file->subtype = 'comment:photo';
								$file->setFile('attachment');
								$file->setPath('comment/photo/');
								$file->setExtension(array(
										'jpg',
										'png',
										'jpeg',
										'jfif',
										'gif',
										'webp',
								));
								if(ossn_file_is_cdn_storage_enabled()) {
										$file->setStore('cdn');
								}
								$file->owner_guid = $this->getAnnotationId();
								if($file->owner_guid !== 0) {
										$file->addFile();
										unlink($full_path);
										unset($_FILES['attachment']);
								}
						}
						$params                 = array();
						$params['id']           = $this->getAnnotationId();
						$params['value']        = $comment;
						$params['subject_guid'] = $subject_id;
						$params['owner_guid']   = $guid;
						ossn_trigger_callback('comment', 'created', $params);
						return $this->getAnnotationId();
				}
				return false;
		}

		/**
		 * Get Comment
		 *
		 * @param integer $id Comment Id
		 *
		 * @return boolean|object
		 */
		public function GetComment($id) {
				if(empty($id)) {
						return false;
				}
				$res_array = $this->searchAnnotation(array(
						'annotation_id' => $id,
						'offset'        => input('comments_offset', '', 1),
				));
				//[B] PHP8 If deleted comments tried to be deleted again #2057
				if($res_array) {
						return $res_array[0];
				}
				return false;
		}

		/**
		 * Count Total Comments on Subject
		 *
		 * @param integer $subject_id Subject id
		 * @param string  $type Comments type
		 *
		 * @return integer
		 */
		public function countComments($subject_id, $type = 'post') {
				$this->subject_guid = $subject_id;
				$this->type         = "comments:{$type}";
				$this->count        = true;
				$this->order_by     = 'a.id ASC';
				$comments           = $this->getAnnotationBySubject();
				if(!empty($comments)) {
						return $comments;
				}
		}

		/**
		 * Get Comments
		 *
		 * @param integer $subject_id Id of item on which users comment
		 * @param integer $type Post or Entity
		 * @param integer $filter Show filterd comments (blocked users don't see each other)
		 *
		 * @return boolean|array
		 */
		public function GetComments($subject, $type = 'post', $filter = true) {
				if(empty($subject)) {
						return false;
				}
				$vars                 = array();
				$vars['subject_guid'] = $subject;
				$vars['type']         = "comments:{$type}";
				$vars['order_by']     = 'a.id DESC';
				if(isset($this->limit)) {
						$vars['limit'] = $this->limit;
				}
				if(!isset($this->page_limit) || $this->page_limit === false) {
						$vars['page_limit'] = false;
				} else {
						$vars['page_limit'] = $this->page_limit;
				}
				$extra_param = array(
						'type' => $type,
				);
				if($filter === true) {
						$attrs    = ossn_call_hook('comments', 'GetComments', $extra_param, $vars);
						$comments = $this->searchAnnotation($attrs);
				} else {
						$comments = $this->searchAnnotation($vars);
				}
				if(!empty($comments)) {
						return array_reverse($comments);
				}
		}

		/**
		 * Delete All Comments by Subject id
		 *
		 * @params $subject: Subject id
		 *
		 * @note [B]getting orphan like records from comments when deleting a post #1687
		 * @note fixed $type as getComments appends comment: itself
		 *
		 * @return bool
		 */
		public function commentsDeleteAll($subject, $type = 'post') {
				//here we need a callback for each comment hence we need a indvidual comment.
				if(empty($subject) || empty($type)) {
						return false;
				}
				//[B]No callback triggered for OssnComments::commentsDeleteAll
				$list = $this->GetComments($subject, $type, false);
				if($list) {
						foreach($list as $comment) {
								$this->deleteComment($comment->id);
						}
						return true;
				}
				return false;
		}

		/**
		 * Delete Comment
		 *
		 * @params $comment: Comment id
		 *
		 * @return bool
		 */
		public function deleteComment($comment) {
				if(empty($comment)) {
						return false;
				}
				$params            = array();
				$params['comment'] = $comment;

				ossn_trigger_callback('comment', 'before:delete', $params);
				if($this->deleteAnnotation($comment)) {
						ossn_trigger_callback('comment', 'delete', $params);
						return true;
				}
				return false;
		}
		/**
		 * Get participants for subject
		 *
		 * @param integer $subject_id Subject GUID
		 * @param string  $type post/object/entity
		 *
		 * @return boolean|array
		 */
		public function getParticipant($subject_id, $type = 'post') {
				if(!empty($subject_id) && !empty($type)) {
						$args = array(
								'params' => array(
										'DISTINCT a.owner_guid',
								),
								'from'   => 'ossn_annotations as a',
								'wheres' => array(
										"a.type='comments:{$type}' AND a.subject_guid={$subject_id}",
								),
						);
						return $this->select($args, true);
				}
				return false;
		}
		/**
		 * Get newly created comment id
		 *
		 * @return int
		 */
		public function getCommentId() {
				return $this->getAnnotationId();
		}
		/**
		 * Get comment photo
		 *
		 * @return string|boolean
		 */
		 public function photoURL(){
			 		if(isset($this->id)){
						 $image = $this->getParam('file:comment:photo');
						 if(!empty($image)) {
							$image = hash('md5', $this->id);
							return ossn_site_url("comment/image/{$this->id}/{$image}.jpg"); 
						 }
					}
					return false;
		 
		 }
		/**
		 * Get comment photo file
		 *
		 * @return boolean|object
		 */		 
		 public function getPhotoFile(){
					$file = new OssnFile();
					$search = $file->searchFiles(array(
								'limit' => 1,
								'owner_guid' => $this->id,
								'type' => 'annotation',
								'subtype' => 'comment:photo',
					));
					if($search){
						return $search[0];	
					}
					return false;
		 }
} //class
