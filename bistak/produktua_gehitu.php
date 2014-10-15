<div class="gehituform">
  <form class="pure-form pure-form-aligned" method="post" action="">
      <fieldset>
          <div class="pure-control-group">
              <label for="pizena">Produktuaren izena</label>
              <input id="pizena" name="pizena" required type="text" placeholder="Larrosa erramua">
          </div>

          <div class="pure-control-group">
              <label for="deskripzioa">Deskripzioa</label>
              <textarea id="deskripzioa" name="deskripzioa" required placeholder="Deskripzio bat gehitu zure produktuari..."></textarea>
          </div>

          <div class="pure-control-group">
              <label for="prezioa">Prezioa</label>
              <input id="prezioa" required type="number" min="0" step="any" placeholder="Prezio bat ezarri" name="prezioa">
          </div>

          <div class="pure-control-group">
              <label for="foo">Stock</label>
              <input id="foo" type="number" min="0" step="any" name="stock" placeholder="Sartu eskura dauden unitateak...">
          </div>
      </fieldset>
      <input type="submit" class='pure-button pure-input-1-6 pure-button-primary formbotoi' id='registro1' value='Produktua datubasera gehitu' name="pgehitu">
  </form>
</div>
