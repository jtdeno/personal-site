<?php

class BlogPostList extends base {

    public static function get_blog_posts() {
        $query = '  SELECT id
                    FROM blog_posts';

        $results = self::$db->query($query)
                            ->resultset();

        if ($results) {
            $blog_posts = array();
            foreach($results as $result) {
                $blog_posts[] = BlogPost::create_from_id($result['id']);
            } return $blog_posts;
        } return false;
    }
}