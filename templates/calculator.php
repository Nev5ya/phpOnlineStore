<form action="/calculator" method="POST" class="calculator_wrapper" id="form">
  <div class="calculator">
    <input type="text" name="output" class="calculator-output_input" value="<?=$params['output']?>">
    <div class="calculator-output"><?=$params['output']?></div>
    <div class="calculator-buttons">
      <div class="calculator-buttons__numbers">
        <div class="calculator-buttons__number button-style">1</div>
        <div class="calculator-buttons__number button-style">2</div>
        <div class="calculator-buttons__number button-style">3</div>
        <div class="calculator-buttons__number button-style">4</div>
        <div class="calculator-buttons__number button-style">5</div>
        <div class="calculator-buttons__number button-style">6</div>
        <div class="calculator-buttons__number button-style">7</div>
        <div class="calculator-buttons__number button-style">8</div>
        <div class="calculator-buttons__number button-style">9</div>
        <div class="calculator-buttons__number button-style">0</div>
        <input type='submit' value="=" class="button-style" id="submit">
        <div class="button-style" id="delete">C</div>
      </div>
      <div class="calculator-buttons__operations">
        <div class="calculator-buttons__operation button-style">+</div>
        <div class="calculator-buttons__operation button-style">-</div>
        <div class="calculator-buttons__operation button-style">*</div>
        <div class="calculator-buttons__operation button-style">/</div>
      </div>
    </div>
  </div>