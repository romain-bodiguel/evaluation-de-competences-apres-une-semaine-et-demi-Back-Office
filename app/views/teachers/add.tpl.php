<div class="container my-4">
        <a href="<?= $router->generate('teachers-list'); ?>" class="btn btn-success float-end">Retour</a>
        <h2>Ajouter un professeur</h2>
        <form action="<?= $router->generate('teacher-create'); ?>" method="POST" class="mt-5">
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom">
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Poste</label>
                <input type="text" class="form-control" id="job" name="job" placeholder="Poste">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="">--Choisissez son status--</option>
                    <option value="1">Actif</option>
                    <option value="2">Inactif</option>
                </select>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary mt-5">Valider</button>
            </div>
        </form>
    </div>