<?php
require_once('db.php');

$posts = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/posts"), true);
$comments = json_decode(file_get_contents("https://jsonplaceholder.typicode.com/comments"), true);

$pdo = getPDO();
$pdo->exec("DELETE FROM comments");
$pdo->exec("DELETE FROM posts");

$stmtPosts = $pdo->prepare("INSERT INTO posts (id, user_id, title, body) VALUES (:id, :user_id, :title, :body)");
foreach ($posts as $post) {
  $stmtPosts->execute([
    ':id' => $post['id'],
    ':user_id' => $post['userId'],
    ':title' => $post['title'],
    ':body' => $post['body']
  ]);
}

$stmtComments = $pdo->prepare("INSERT INTO comments (id, post_id, name, email, body) VALUES (:id, :post_id, :name, :email, :body)");
foreach ($comments as $comment) {
  $stmtComments->execute([
    ':id' => $comment['id'],
    ':post_id' => $comment['postId'],
    ':name' => $comment['name'],
    ':email' => $comment['email'],
    ':body' => $comment['body']
  ]);
}

echo "Загружено " . count($posts) . " записей и " . count($comments) . " комментариев";
