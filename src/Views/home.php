<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="{{ css('styles.css') }}">
</head>
<body>
    <header>
        <!-- <img src="{{ image('logo.png') }}" alt="Phlask Logo" class="logo"> -->
        <h1><?= htmlspecialchars($title) ?></h1>
    </header>

    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h2>Welcome to Phlask</h2>
            <p>This is a simple PHP micro-framework inspired by Flask. It's designed to be lightweight and easy to use.</p>
        </section>

        <section>
            <h2>Features</h2>
            <ul>
                <li>Simple routing</li>
                <li>Template rendering</li>
                <li>Static asset management</li>
                <li>Easy to extend</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Phlask Framework. All rights reserved.</p>
    </footer>

    <script src="{{ js('app.js') }}"></script>
</body>
</html>