<?php
$success = false;
$errors = [];
$name = $email = $message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') $errors[] = 'El nombre es obligatorio.';
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido.';
    if ($message === '') $errors[] = 'Por favor indica en qué te gustaría ayudar.';

    if (empty($errors)) {
        $logLine = sprintf("[%s] VOLUNTARIADO | %s <%s> -- %s\n", date('Y-m-d H:i:s'), $name, $email, str_replace("\n", " ", $message));
        $file = __DIR__ . '/../Resources/messages.txt';
        file_put_contents($file, $logLine, FILE_APPEND | LOCK_EX);
        $success = true;
        $name = $email = $message = '';
    }
}
?>

<section class="voluntariado">
    <h2>Voluntariado</h2>
    <p>¿Quieres colaborar con nosotros? Rellena el formulario y te contactaremos.</p>

    <?php if ($success): ?>
        <div class="alert success">¡Gracias! Hemos recibido tu solicitud de voluntariado.</div>
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

    <form action="/Pages/voluntariado.php" method="post" class="contact-form" novalidate>
        <label for="v-name">Nombre y apellidos</label>
        <input id="v-name" name="name" type="text" value="<?php echo htmlspecialchars($name); ?>" required />

        <label for="v-email">Correo electrónico</label>
        <input id="v-email" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" required />

        <label for="v-message">¿En qué te gustaría ayudar?</label>
        <textarea id="v-message" name="message" rows="4" required><?php echo htmlspecialchars($message); ?></textarea>

        <button type="submit">Inscribirme</button>
    </form>
</section>
