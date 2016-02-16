<div class="container">
    <br/>
    <?php echo form_open('previsonnel/modifier/' . $previsionnel->id); ?>
    <fieldset>

        <ul class="nav nav-tabs" role="tablist">
            <li class="active" role="presentation"><a href="#bases_calculs" role="tab" data-toggle="tab">Bases de calculs</a></li>
            <li class="" role="presentation"><a href="#bases_calculs2" role="tab" data-toggle="tab">Bases de calculs2</a></li>
        </ul>

        <div class="tab-content">

            <!-- Bases de calculs -->
            <div role="tabpanel" class="tab-pane fade active in" id="bases_calculs">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    Surface et typologie
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="row-centered" style="margin:0;">
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="surface_terrain">Surface terrain *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="surface_terrain" name="surface_terrain" type="text" placeholder="Surface terrain (m²)" class="form-control" value="<?php echo set_value('surface_terrain', 0); ?>" required>
                                            <?php echo form_error('surface_terrain'); ?>
                                        </div>
                                    </div>
                                    <legend>
                                        SHAB logements / SU commerces : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="SHAB_fini">logements finis *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="SHAB_fini" name="SHAB_fini" type="text" placeholder="SHAB logements finis (m²)" class="form-control" value="<?php echo set_value('SHAB_fini', 0); ?>" required>
                                            <?php echo form_error('SHAB_fini'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="SHAB_bruts">logements bruts *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="SHAB_bruts" name="SHAB_bruts" type="text" placeholder="SHAB logements bruts (m²)" class="form-control" value="<?php echo set_value('SHAB_bruts', 0); ?>" required>
                                            <?php echo form_error('SHAB_bruts'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="zone_tertiaire">Zone tertiaire *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="zone_tertiaire" name="zone_tertiaire" type="text" placeholder="Zone tertiaire (m²)" class="form-control" value="<?php echo set_value('zone_tertiaire', 0); ?>" required>
                                            <?php echo form_error('zone_tertiaire'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parties_communes">Parties communes *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parties_communes" name="parties_communes" type="text" placeholder="Parties communes (m²)" class="form-control" value="<?php echo set_value('parties_communes', 0); ?>" required>
                                            <?php echo form_error('parties_communes'); ?>
                                        </div>
                                    </div>

                                    <legend>
                                        Nombres de lots : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="lots_fini">Finis *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="lots_fini" name="lots_fini" type="text" placeholder="Logements finis" class="form-control" value="<?php echo set_value('lots_fini', 0); ?>" required>
                                            <?php echo form_error('lots_fini'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="lots_bruts">Bruts *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="lots_bruts" name="lots_bruts" type="text" placeholder="Logements bruts" class="form-control" value="<?php echo set_value('lots_bruts', 0); ?>" required>
                                            <?php echo form_error('lots_bruts'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="lots_tertiaire">Tertiaire *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="lots_tertiaire" name="lots_tertiaire" type="text" placeholder="Zone tertiaire" class="form-control" value="<?php echo set_value('lots_tertiaire', 0); ?>" required>
                                            <?php echo form_error('lots_tertiaire'); ?>
                                        </div>
                                    </div>

                                    <legend>
                                        Nombres de parkings extérieurs : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ext_fini">Logements finis *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ext_fini" name="parking_ext_fini" type="text" placeholder="Parkings finis" class="form-control" value="<?php echo set_value('parking_ext_fini', 0); ?>" required>
                                            <?php echo form_error('parking_ext_fini'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ext_bruts">Logements bruts *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ext_bruts" name="parking_ext_bruts" type="text" placeholder="Parking bruts" class="form-control" value="<?php echo set_value('parking_ext_bruts', 0); ?>" required>
                                            <?php echo form_error('parking_ext_bruts'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ext_tertiaire">Zone tertiaire *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ext_tertiaire" name="parking_ext_tertiaire" type="text" placeholder="Parking tertiaire" class="form-control" value="<?php echo set_value('parking_ext_tertiaire', 0); ?>" required>
                                            <?php echo form_error('parking_ext_tertiaire'); ?>
                                        </div>
                                    </div>

                                    <legend>
                                        Nombres de parkings sous-sol : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ss_fini">Logements finis *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ss_fini" name="parking_ss_fini" type="text" placeholder="Parkings finis" class="form-control" value="<?php echo set_value('parking_ss_fini', 0); ?>" required>
                                            <?php echo form_error('parking_ss_fini'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ss_bruts">Logements bruts *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ss_bruts" name="parking_ss_bruts" type="text" placeholder="Parking bruts" class="form-control" value="<?php echo set_value('parking_ss_bruts', 0); ?>" required>
                                            <?php echo form_error('parking_ss_bruts'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_ss_tertiaire">Zone tertiaire *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_ss_tertiaire" name="parking_ss_tertiaire" type="text" placeholder="Parking tertiaire" class="form-control" value="<?php echo set_value('parking_ss_tertiaire', 0); ?>" required>
                                            <?php echo form_error('parking_ss_tertiaire'); ?>
                                        </div>
                                    </div>

                                    <legend>
                                        Nombres de caves : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="cave_fini">Logements finis *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="cave_fini" name="cave_fini" type="text" placeholder="Caves finis" class="form-control" value="<?php echo set_value('cave_fini', 0); ?>" required>
                                            <?php echo form_error('cave_fini'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="cave_bruts">Logements bruts *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="cave_bruts" name="cave_bruts" type="text" placeholder="Caves bruts" class="form-control" value="<?php echo set_value('cave_bruts', 0); ?>" required>
                                            <?php echo form_error('cave_bruts'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="cave_tertiaire">Zone tertiaire *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="cave_tertiaire" name="cave_tertiaire" type="text" placeholder="Caves tertiaire" class="form-control" value="<?php echo set_value('cave_tertiaire', 0); ?>" required>
                                            <?php echo form_error('cave_tertiaire'); ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Coûts fonciers
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="panel-body">
                                <div class="row-centered" style="margin:0;">
                                    <legend>
                                        Foncier en numéraire : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="foncier_HT">HT *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="foncier_HT" name="foncier_HT" type="text" placeholder="Foncier HT" class="form-control" value="<?php echo set_value('foncier_HT', 0); ?>" required>
                                            <?php echo form_error('foncier_HT'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="foncier_TVA">TVA *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="foncier_TVA" name="foncier_TVA" type="text" placeholder="Foncier TVA" class="form-control" value="<?php echo set_value('foncier_TVA', 0); ?>" required>
                                            <?php echo form_error('foncier_TVA'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="foncier_frais_notaire_enregistrement">% frais de notaire et d'enregistrement *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="foncier_frais_notaire_enregistrement" name="foncier_frais_notaire_enregistrement" type="text" placeholder="% Frais de notaire et d'enregistrement" class="form-control" value="<?php echo set_value('foncier_frais_notaire_enregistrement', 0); ?>" required>
                                            <?php echo form_error('foncier_frais_notaire_enregistrement'); ?>
                                        </div>
                                    </div>
                                    <br/>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="foncier_frais_notaire_enregistrement_HT_TTC">Frais sur HT ou TTC *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <select id="foncier_frais_notaire_enregistrement_HT_TTC" name="foncier_frais_notaire_enregistrement_HT_TTC" class="form-control">
                                                <option value='HT' <?php echo set_select('foncier_frais_notaire_enregistrement_HT_TTC', 'HT', TRUE); ?>>HT</option>
                                                <option value='TTC' <?php echo set_select('foncier_frais_notaire_enregistrement_HT_TTC', 'TTC'); ?>>TTC</option>
                                            </select>
                                            <?php echo form_error('foncier_frais_notaire_enregistrement_HT_TTC'); ?>
                                        </div>
                                    </div>
                                    <legend>
                                        Parkings : 
                                    </legend>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_HT">HT *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_HT" name="parking_HT" type="text" placeholder="Parking HT" class="form-control" value="<?php echo set_value('parking_HT', 0); ?>" required>
                                            <?php echo form_error('parking_HT'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_TVA">TVA *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_TVA" name="parking_TVA" type="text" placeholder="Parking TVA" class="form-control" value="<?php echo set_value('parking_TVA', 0); ?>" required>
                                            <?php echo form_error('parking_TVA'); ?>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_frais_notaire_enregistrement">% frais de notaire et d'enregistrement *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <input id="parking_frais_notaire_enregistrement" name="parking_frais_notaire_enregistrement" type="text" placeholder="% Frais de notaire et d'enregistrement" class="form-control" value="<?php echo set_value('parking_frais_notaire_enregistrement', 0); ?>" required>
                                            <?php echo form_error('parking_frais_notaire_enregistrement'); ?>
                                        </div>
                                    </div>
                                    <br/>
                                    <!-- Text input-->
                                    <div class="control-group">
                                        <label class="control-label col-sm-2 col-centered" for="parking_frais_notaire_enregistrement_HT_TTC">Frais sur HT ou TTC *</label>
                                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                                            <select id="parking_frais_notaire_enregistrement_HT_TTC" name="parking_frais_notaire_enregistrement_HT_TTC" class="form-control">
                                                <option value='HT' <?php echo set_select('parking_frais_notaire_enregistrement_HT_TTC', 'HT', TRUE); ?>>HT</option>
                                                <option value='TTC' <?php echo set_select('parking_frais_notaire_enregistrement_HT_TTC', 'TTC'); ?>>TTC</option>
                                            </select>
                                            <?php echo form_error('parking_frais_notaire_enregistrement_HT_TTC'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Bases de calculs2 -->
            <div role="tabpanel" class="tab-pane fade" id="bases_calculs2">
                test
            </div>
        </div>

        <div class="col-xs-12" style="margin-top:20px;">
            <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
            <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Modifier"/>
        </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>