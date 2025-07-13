<?php
$channel_id = "UCzz4l5hPbEQ9JRetCgZM83w";  // Ganti dengan channel ID kamu
$feed_url = "https://www.youtube.com/feeds/videos.xml?channel_id=$channel_id";
$xml = @simplexml_load_file($feed_url);

// Default videos (id dan title)
$videos = [
    ['id' => "dQw4w9WgXcQ", 'title' => "Default Video 1"],
    ['id' => "eY52Zsg-KVI", 'title' => "Default Video 2"],
    ['id' => "M7lc1UVf-VE", 'title' => "Default Video 3"],
    ['id' => "kxopViU98Xo", 'title' => "Default Video 4"],
];

if ($xml !== false && isset($xml->entry)) {
    $videos = [];
    foreach ($xml->entry as $entry) {
        $vid = str_replace("yt:video:", "", $entry->id);
        $title = (string) $entry->title;
        $videos[] = ['id' => $vid, 'title' => $title];
        if (count($videos) >= 4) break; // ambil 4 video terbaru
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>DURKWHIPS</title>
  <link rel="stylesheet" href="style/style.css" />
  <link rel="icon" href="../asset/icon.png" type="image/png" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
  <div class="container">
    <h1>Durkwhips</h1>
    <h2>⬇ ⬇ New Update ⬇ ⬇</h2>

    <!-- Video utama -->
    <?php if (count($videos) > 0): ?>
      <iframe src="https://www.youtube.com/embed/<?php echo htmlspecialchars($videos[0]['id']); ?>" allowfullscreen></iframe>
      <p style="margin-top:-15px; margin-bottom:20px; font-weight:bold;"><?php echo htmlspecialchars($videos[0]['title']); ?></p>
    <?php else: ?>
      <p>Tidak ada video tersedia.</p>
    <?php endif; ?>

    <!-- Video lainnya -->
    <?php if (count($videos) > 1): ?>
      <div class="video-list-wrapper">
        <div class="video-list">
          <?php
          for ($i = 1; $i < count($videos); $i++) {
            $vid = htmlspecialchars($videos[$i]['id']);
            $title = htmlspecialchars($videos[$i]['title']);
            echo '<a href="https://www.youtube.com/watch?v=' . $vid . '" target="_blank" class="video-item">';
            echo '<img src="https://img.youtube.com/vi/' . $vid . '/mqdefault.jpg" alt="' . $title . '" />';
            echo '<p>' . $title . '</p>';
            echo '</a>';
          }
          ?>
        </div>
      </div>
    <?php endif; ?>

    <!-- Link tombol -->
    <a class="btn" href="https://www.youtube.com/@denrio157" target="_blank">📺 YouTube</a>
    <a class="btn" href="https://www.instagram.com/denrio157" target="_blank">📷 Instagram</a>
    <a class="btn" href="https://t.me/denrio157" target="_blank">📨 Telegram</a>
  </div>
</body>
</html>
