<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">Contacts</a></li>
        <li role="presentation"><a href="#entreprises" aria-controls="entreprise" role="tab" data-toggle="tab">Entreprises</a></li>
    </ul>


    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="contacts">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row"><a href="contact/ajouter" class="btn btn-info pull-right">Créer un nouveau contact</a></div>
                <?php
                $x = 0;
                foreach ($contacts as $contact) {
                    $x++;
                    ?>
                    <div class="panel panel-default searchable" data-search="<?php echo $contact->nom . ' ' . $contact->prenom; ?>">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x; ?>" aria-expanded="false" aria-controls="collapseOne">
                                    <?php echo $contact->nom . ' ' . $contact->prenom; ?>
                                    <a data-toggle="tooltip" title="" data-original-title="Actions" href="<?php echo site_url('actionsContacts/liste/' . $contact->id); ?>" style='margin-left:20px;color:' class="a-fiche-contact">
                                        <i class='fa fa-list-ul'></i>
                                    </a>
                                    <a data-toggle="tooltip" title="" data-original-title="Rappels" href="<?php echo site_url('rappel/liste/' . $contact->id); ?>" style='margin-left:20px;color:' class="a-fiche-contact">
                                        <i class='fa fa-clock-o'></i>
                                    </a>
                                    <a href="<?php echo site_url('contact/modifier/' . $contact->id); ?>" style='margin-left:20px;color:' class="a-fiche-contact">
                                        <i class='fa fa-gears'></i>
                                    </a>
                                    <a class="a-fiche-contact" data-toggle="tooltip" title="" data-original-title="Fiche de renseignement contact" href="<?= base_url('fiche-contact/vue/'.$contact->id); ?>">
                                        <i class="fa fa-file-text"></i>
                                    </a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row marginLeft">
                                    <div class="col-md-6">
                                        <p><?php if($contact->adresse){echo "Adresse : $contact->adresse";} ?></p>
                                        <p><?php if($contact->cp){echo "Code postal : $contact->cp";} ?></p>
                                        <p><?php if($contact->ville){echo "Ville : $contact->ville";} ?></p>
                                        <p><?php if($contact->fixe){echo "Fixe : $contact->fixe";} ?></p>
                                        <p><?php if($contact->portable){echo "Portable : $contact->portable";} ?></p>
                                        <p><?php if($contact->email){echo "Email : <a href='$contact->email'>$contact->email</a>";} ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                            $data = json_decode($contact->data); 
                                            foreach($data->champs_persos as $key => $value){
                                                echo "<p>$key : $value</p>";
                                            }
                                            echo '<br/><h4>Entreprises : </h4>';
                                            foreach($contact->entreprises as $entreprise){
                                                echo $entreprise[0]->poste.' de '.$entreprise[0]->nom.'<br/>';
                                            }
                                        ?>
                                    </div> 
                                </div>  
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane fade" id="entreprises">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="row"><a href="entreprise/ajouter" class="btn btn-info pull-right">Créer une nouvelle entreprise</a></div>
                <?php
                $x = 0;
                foreach ($entreprises as $entreprise) {
                    $x++;
                ?>
                    <div class="panel panel-default searchable" data-search="<?php echo $entreprise->nom?>">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#entreprise<?php echo $x; ?>" aria-expanded="false" aria-controls="collapseOne">
                                    <?php echo $entreprise->nom; ?><a href="<?php echo site_url('entreprise/modifier/' . $entreprise->id); ?>" style='margin-left:20px;color:' class="a-fiche-contact"><i class='fa fa-gears'></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="entreprise<?php echo $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row marginLeft">
                                    <div class="col-md-6">
                                        <p><?php if($entreprise->siret){echo "Siret : $entreprise->siret";} ?></p>
                                        </div>
                                    <div class="col-md-6">
                                        <?php 
                                            $data = json_decode($entreprise->data); 
                                            if($data != NULL){
                                                foreach($data->champs_persos as $key => $value){
                                                    echo "<p>$key : $value</p>";
                                                }
                                            }
                                            
                                        ?>
                                    </div> 
                                </div>                      
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
