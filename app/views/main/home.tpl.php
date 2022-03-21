    <div class="container my-4">
        <p class="display-4">
            Bienvenue dans le backOffice <strong>de l'école 100% en ligne dont toute ressemblance avec des personnages ayant réellement existé serait purement fortuite</strong>...
        </p>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <div class="card text-white mb-3">
                    <div class="card-header bg-primary">Liste des profs</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                    <th scope="col">Job</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($teachersData as $id => $currentTeacher) : ?>
                                <tr>
                                    <th scope="row"><?= ($id+1); ?></th>
                                    <td><?= $currentTeacher->getFirstname() ?></td>
                                    <td><?= $currentTeacher->getLastname() ?></td>
                                    <td><?= $currentTeacher->getJob() ?></td>
                                    <td class="text-end">
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="categories.html" class="btn btn-success">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card text-white mb-3">
                    <div class="card-header bg-primary">Liste des élèves</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prénom</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($studentsData as $id => $currentStudent) : ?>
                                <tr>
                                    <th scope="row"><?= ($id+1); ?></th>
                                    <td><?= $currentStudent->getFirstname(); ?></td>
                                    <td><?= $currentTeacher->getLastname() ?></td>
                                    <td class="text-end">
                                        <a href="" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>
                                        <!-- Example single danger button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="d-grid gap-2">
                            <a href="products.html" class="btn btn-success">Voir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

