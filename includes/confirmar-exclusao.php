<main>

    <section>

    </section>

    <h2 class="mt-3">Confirmar Exclusao</h2>

    <form method="post">

        <div class="form-group">
           
            <p>Confirmar exclusão da vaga <strong><?=$obVaga->titulo?></strong></p>

        </div>

        <div class="form-group"> 
            <a href="index.php">
                <button type="button" class="btn btn-success">Cancelar</button>
            </a>

                <button type="submit" name="excluir" class="btn btn-danger mt-3">Excluir</button>
        </div>

    </form>

</main>