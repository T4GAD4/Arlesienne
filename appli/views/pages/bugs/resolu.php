<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>
                    Bug résolu! 
                    <a href="<?php echo base_url().'bugs/dashboard'; ?>" class="btn btn-default pull-right" role="button">Retour aux bugs</a>
                </h1>
                <hr/>
            </div>

            <?php echo form_open_multipart('bugs/dashboard/resolu/'.$bug); ?>
                
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12">
                          <label for="explication">Description de la résolution</label>
                          <textarea name="explication" placeholder="Soyez le plus précis possible, les explications aident les futurs développeurs en cas de problème similaire! Ne pas hésiter à mettre du code ici! :)" class="form-control" rows="7"></textarea>
                        </div>
                        <?php echo form_error('explication'); ?>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12 pull-right">
                            <button type="submit" class="btn btn-default pull-right">Résoudre!</button>
                        </div>
                    </div>
                </div>
            <?php echo  form_close(); ?>
        </div>
    </body>
</html>