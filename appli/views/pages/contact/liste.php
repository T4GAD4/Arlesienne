<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <input id="search" type="text" class="input-md form-control" placeholder="Rechercher..."/>

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
                                        ?>
                                    </div> 
                                </div>      
                                <a href="<?php echo site_url('contact/modifier/' . $contact->id); ?>" class="btn btn-info pull-right">Modifier</a> 
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
                                    <?php echo $entreprise->nom; ?>
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
                                <a href="<?php echo site_url('entreprise/modifier/' . $entreprise->id); ?>" class="btn btn-info pull-right">Modifier</a> 
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
