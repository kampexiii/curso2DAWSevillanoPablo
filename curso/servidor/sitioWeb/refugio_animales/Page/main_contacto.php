<?php
$success = false;
$errors = [];

// Inicializar variables para reuso en el form
$name = $email = $message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') $errors[] = 'El nombre es obligatorio.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
    if ($message === '') $errors[] = 'El mensaje no puede estar vacío.';

    if (empty($errors)) {
        $logLine = sprintf("[%s] CONTACTO | %s <%s> -- %s\n", date('Y-m-d H:i:s'), $name, $email, str_replace("\n", " ", $message));
        $file = __DIR__ . '/../Resources/messages.txt';
        file_put_contents($file, $logLine, FILE_APPEND | LOCK_EX);
        $success = true;
        $name = $email = $message = '';
    }
}
?>

<section class="contact">
    <h2>Contacto</h2>

    <?php if ($success): ?>
        <div class="alert success">Gracias, tu mensaje ha sido recibido. Te contestaremos en breve.</div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert error">
            <ul>
                <?php foreach ($errors as $err): ?>
                    <li><?php echo htmlspecialchars($err); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/Pages/contacto.php" method="post" class="contact-form" novalidate>
        <label for="name">Nombre y apellidos</label>
        <input id="name" name="name" type="text" value="<?php echo htmlspecialchars($name); ?>" required />

        <label for="email">Correo electrónico</label>
        <input id="email" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" required />

        <label for="message">Mensaje</label>
        <textarea id="message" name="message" rows="6" required><?php echo htmlspecialchars($message); ?></textarea>

        <button type="submit">Enviar mensaje</button>
    </form>

    <p class="note">También puedes visitarnos en persona en nuestro horario de atención.</p>
</section>
