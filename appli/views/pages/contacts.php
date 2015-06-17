<div class="container">
    <h1>Contacts :</h1>
    <br/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
            <input type="search" id="search" class="form-control search" onkeyup="search()" id="search" placeholder="Rechercher un contact..." />
        </div>
    </div>
    <br/><br/>
    <ul class="list-group">
        <?php 
            foreach ($contacts as $contact){
                if($contact->societe != ""){
                    echo '<li class="list-group-item searchable" data-search="'.$contact->societe.' '.$contact->nom.' '.$contact->prenom.' '.$contact->mail.' '.$contact->telephone_port.' '.$contact->telephone_fixe.'"><b>'.$contact->societe.'</b> - '.$contact->nom.' '.$contact->prenom.' <p class="pull-right">'.$contact->mail.' <span class="divider-vertical"></span> '.$contact->telephone_port.' <span class="divider-vertical"></span> '.$contact->telephone_fixe.'</p></li>';
                }else{
                    echo '<li class="list-group-item searchable" data-search="'.$contact->societe.' '.$contact->nom.' '.$contact->prenom.' '.$contact->mail.' '.$contact->telephone_port.' '.$contact->telephone_fixe.'">'.$contact->nom.' '.$contact->prenom.' <p class="pull-right">'.$contact->mail.' <li class="divider-vertical"></li> '.$contact->telephone_port.' <span class="divider-vertical"></span> '.$contact->telephone_fixe.'</p></li>';
                }
            }
        ?>
    </ul>
</div>