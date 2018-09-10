<div class="note note-danger">
    <h4 class="block">Dostęp zabroniony</h4>
    <p>
        Tabela płac wymaga autoryzacji!<br>
        Podaj hasło to samo co służy do logowania konta  aby zobaczyć tabele.
    </p>
</div>
<?php echo $this->Form->create(); ?>
<div class="form-group">
    <label for="exampleInputPassword42" class="sr-only">Hasło</label>
    <div class="input-icon input-group">
        <i class="fa fa-lock fa-fw"></i>
        <input name="data[password]" type="password" placeholder="Password" id="exampleInputPassword42" class="form-control">
        <span class="input-group-btn">
            <button  type="submit" class="btn blue">Wyślij</button>
        </span>
    </div>
</div>
<?php echo $this->Form->end(); ?>