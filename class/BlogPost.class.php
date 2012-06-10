<?php

class BlogPost extends Base {
    protected $id;
    protected $user_id;
    protected $title;
    protected $content;
    protected $date_created;

    function __construct($blog_info = array()) {
        parent::__construct();

        if (count($blog_info) > 0) {
            foreach ($blog_info as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public static function create_from_id($id) {
        $query = '  SELECT id, user_id, title, content, date_created
                    FROM blog_posts
                    WHERE id = :id';

        $result = self::$db ->query($query)
                            ->bind(':id', $id)
                            ->single();

        if ($result) {
            return new static($result);
        } return false;
    }

    public function save() {
        if (!isset($this->id)) {
        	// Creating a new blog post
            $query = '  INSERT INTO blog_posts
                        (user_id, title, content)
                        VALUES (:user_id, :title, :content)';

            $result = $this->_db->query($query)
                                ->bind(':user_id', $this->user_id)
                                ->bind(':title', $this->title)
                                ->bind(':content', $this->content)
                                ->execute();
        } else {
			// Modifying an existing blog post
			$query = '	UPDATE blog_posts
						SET
							title = :title,
							content = :content,
							last_modified_date = now(),
							last_modified_user_id = :user_id
						WHERE id = :id';

			$result = $this->_db->query($query)
								->bind(':title', $this->title)
								->bind(':content', $this->content)
								->bind(':user_id', $this->user_id)
								->bind(':id', $this->id)
								->execute();
        }

		if ($result) {
			return true;
		} return false;
    }

	public function get_date_created() {
		return DateTime::createFromFormat('Y-m-d H:i:s', $this->date_created);
	}

}