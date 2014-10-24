<div class="aldatuform">
  <form class="pure-form pure-form-aligned" method="post" action="">
      <fieldset>
          <div class="pure-control-group">
              <label for="izena">Produktuaren izena</label>
              <input id="izena" name="pizena" type="text" placeholder="<?php echo $this->zeozeLortu('izena'); ?>">
          </div>

          <div class="pure-control-group">
              <label for="deskripzioa">Deskripzioa</label>
              <input type="text" style="height:100px;"id="deskripzioa" name="deskripzioa" placeholder="<?php echo $this->zeozeLortu('deskripzioa'); ?>">
          </div>

          <div class="pure-control-group">
              <label for="prezioa">Prezioa</label>
              <input id="prezioa" type="number" min="0" step="any" placeholder="<?php echo $this->zeozeLortu('prezioa'); ?>" name="prezioa">
          </div>

          <div class="pure-control-group">
              <label for="foo">Stock</label>
              <input id="foo" type="number" min="0" step="any" name="stock" placeholder="<?php echo $this->zeozeLortu('stock'); ?>">
          </div>
      </fieldset>
      <input type="submit" class='pure-button pure-input-1-6 pure-button-primary formbotoi' id='aldatu' value='Produktua datubasera gehitu' name="paldatu">
  </form>
</div>
