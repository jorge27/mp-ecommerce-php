<div class="as-search-results as-filter-open as-category-landing as-desktop" id="as-search-results">
    <h1>Ingrese sus Datos</h1>
    <form method="POST">
        <input type="hidden" name="product-name" value="<?php echo $_GET['product-name']?>">
        <input type="hidden" name="product-unit" value="<?php echo $_GET['product-unit']?>">
        <input type="hidden" name="product-price" value="<?php echo $_GET['product-price']?>">
        <input type="hidden" name="product-img" value="<?php echo $_GET['product-img']?>">
        <div>
            <label for="name">Nombre</label>
            <input type="text" name="name" value="<?php echo $_POST['name']; ?>">
        </div>
        <div>
            <label for="surname">Apellido</label>
            <input type="text" name="surname" value="<?php echo $_POST['surname']; ?>">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?php echo $_POST['email']; ?>">
        </div>
        <div>
            <label for="phone">Telefono</label>
            <input type="text" name="phone" value="<?php echo $_POST['phone']; ?>">
        </div>
        <div>
            <label for="street">calle</label>
            <input type="text" name="street" value="<?php echo $_POST['street']; ?>">
        </div>
        <div>
            <label for="number_street">Número</label>
            <input type="text" name="number_street" value="<?php echo $_POST['number_street']; ?>">
        </div>
        <div>
            <label for="cp">Código Postal</label>
            <input type="text" name="cp" value="<?php echo $_POST['cp']; ?>">
        </div>
        <div>
            <label for="installments">Pagar en mensualidades</label>
            <input type="number" min="1" max="6" name="installments" onkeypress="event.preventDefault();" value="<?php echo isset($_POST['installments']) ? $_POST['installments'] : 1; ?>">
        </div>
        <input type="submit" value="Enviar">
    </form>
</div>
