<?php 
require "includes/funciones.php";
incluirTemplate("header"); 
?>

<main class="blog">
  <div class="contenedor-tarjeta">
    <div class="card-contenedor-tarjeta">
      <div class="front">
        <div class="image">
          <img src="image/chip.png" alt="" />
          <img src="image/visa.png" alt="" />
        </div>
        <div class="card-number-box">################</div>
        <div class="flexbox">
          <div class="box">
            <span>Nombre Propietario</span>
            <div class="card-holder-name">nombre</div>
          </div>
          <div class="box">
            <span>expiracción</span>
            <div class="expiration">
              <span class="exp-month">mm</span>
              <span class="exp-year">yy</span>
            </div>
          </div>
        </div>
      </div>

      <div class="back">
        <div class="stripe"></div>
        <div class="box">
          <span>cvv</span>
          <div class="cvv-box"></div>
          <img src="image/visa.png" alt="" />
        </div>
      </div>
    </div>

    <form action="">
      <div class="inputBox">
        <span>Número de Tarjeta</span>
        <input type="text" maxlength="16" class="card-number-input" />
      </div>
      <div class="inputBox">
        <span>Nombre de Propietario</span>
        <input type="text" class="card-holder-input" />
      </div>
      <div class="flexbox">
        <div class="inputBox">
          <span>expiracción mm</span>
          <select name="" id="" class="month-input">
            <option value="month" selected disabled>mes</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
          </select>
        </div>
        <div class="inputBox">
          <span>expiracción yy</span>
          <select name="" id="" class="year-input">
            <option value="year" selected disabled>año</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
          </select>
        </div>
        <div class="inputBox">
          <span>cvv</span>
          <input type="text" maxlength="3" class="cvv-input" />
        </div>
      </div>
      <input type="BUTTON" value="CONFIRMAR" class="submit-btn" />
    </form>
  </div>
</main>

<!-- Creamos nuestro footer -->
<?php incluirTemplate("footer"); ?>
