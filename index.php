<?php
require_once('db.php');

$pdo = getPDO();
$results = [];
$query = "";
$errorOccured = false;

if (isset($_GET['query'])) {
  if (strlen($_GET['query']) < 3) {
    $errorOccured = true;
  } else {
    $query = $_GET['query'];
    $stmt = $pdo->prepare("
        SELECT posts.title, comments.body AS comment
        FROM comments
        INNER JOIN posts ON posts.id = comments.post_id
        WHERE comments.body LIKE :search
    ");
    $stmt->execute([':search' => "%$query%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Поиск записей по тексту комментария</title>
</head>

<body>
  <h1>Поиск записей по тексту комментария</h1>
  <form method="get">
    <input type="text" name="query" value="<?= htmlspecialchars($query) ?>" placeholder="Текст комментария" required>
    <button type="submit">Найти</button>
  </form>

  <?php if ($errorOccured): ?>
    <p>Введите более двух символов.</p>
  <?php elseif (!empty($results)): ?>
    <h2>Результаты поиска:</h2>
    <ul>
      <?php foreach ($results as $row): ?>
        <li>
          <strong><?= htmlspecialchars($row['title']) ?></strong><br>
          <?= htmlspecialchars($row['comment']) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php elseif ($query): ?>
    <p>Записи не найдены.</p>
  <?php endif; ?>
</body>

</html>