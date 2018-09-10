<div class="row">
    <div class="col-xs-12">
        <div class="profile-sidebar right-profile">
            <?php echo $this->Metronic->portlet(__d('public', 'Pytania opcjonalne')); ?>
            <div class="clearfix option-choose">
                <a href="#" class="min-width-118 margin-bottom-10 margin-right-10 poitnier btn btn-sm margin-bottom pull-left green-haze"><?php echo __d('public', 'WWW') ?></a>
                <a href="#" class="min-width-118 margin-bottom-10 margin-right-10 poitnier btn btn-sm margin-bottom pull-left green-haze"><?php echo __d('public', 'Facebook') ?></a>
                <a href="#" class="min-width-118 margin-bottom-10 margin-right-10 poitnier btn btn-sm margin-bottom pull-left default"><?php echo __d('public', 'Zintegrowany') ?></a>
                <a href="#" class="min-width-118 margin-bottom-10 margin-right-10 poitnier btn btn-sm margin-bottom pull-left default"><?php echo __d('public', 'Buzz') ?></a>
            </div>
            <div class="clearfix">
                <div class="panel panel-default margin-top-15">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo __d('public', 'IT') ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="clearfix margin-bottom-10">
                            <input type="text" class="form-control" />
                        </div>
                        <div class="clearfix margin-bottom-10">
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="panel panel-default margin-top-15">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo __d('public', 'SEO') ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="clearfix margin-bottom-10">
                            <input type="text" class="form-control" />
                        </div>
                        <div class="clearfix margin-bottom-10">
                            <input type="text" class="form-control" />
                        </div>
                    </div>
                </div>
                <?php echo $this->Metronic->portlet(__d('public', 'Opcje'), 0, 'fa fa-cogs', 'blue', 0, null, 0); ?>

                    <div class="panel-body no-padding">
                        <div class="clearfix row">
                            <div class="col-xs-12">
                                <div class="padding-top-15 padding-bottom-15">
                                    <div class="clearfix title">
                                        <span class="pull-left uppercase bold"><?php echo __d('public', 'DODAJ KATEGORIĘ') ?></span>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="clearfix">
                                        <span class="small"><?php echo __d('public', 'Wprowadź nazwę kategorii i naciśnij Enter') ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <div class="padding-top-15 padding-bottom-15">
                                    <div class="clearfix title">
                                        <span class="pull-left uppercase bold"><?php echo __d('public', 'DODAJ PYTANIE') ?></span>
                                    </div>
                                    <div class="clearfix margin-top-10">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="clearfix">
                                        <span class="small"><?php echo __d('public', 'Wprowadź treść pytania i naciśnij Enter') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo $this->Metronic->portletEnd(); ?>
            </div>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>
        <div class="profile-content">
            <?php echo $this->Metronic->portlet(__d('public', 'Brief [pytanie oferowe]')); ?>
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <?php echo $this->Metronic->portlet(__d('public', 'Informacje'), 0, null, 'blue', 0, null, 1); ?>
                    <div class="clearfix second-silver">
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Tytuł briefa') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Data  utworzenia') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <div class="input-icon right">
                                        <i class="icon-calendar"></i>
                                        <input type="text" name=""  class="form-control form-control-inline" side="right">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Opiekun klienta') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'SKĄD DOWIEDZIELI SIĘ PAŃSTWO O NASZEJ FIRMIE') ?>?</span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                </div>
                <div class="col-md-6 col-xs-12">
                    <?php echo $this->Metronic->portlet(__d('public', 'Marka/Produkt'), 0, null, 'purple', 0, null, 1); ?>
                    <div class="clearfix second-silver">
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Tytuł briefa') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold color-red"><?php echo __d('public', 'Tytuł briefa ukryty') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15 hidden">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="padding-top-15 padding-bottom-15">
                                <div class="clearfix title">
                                    <span class="pull-left uppercase bold"><?php echo __d('public', 'Tytuł briefa') ?></span>
                                    <a href="#" class="pull-right">
                                        <span class="close"> x </span>
                                    </a>
                                </div>
                                <div class="clearfix margin-top-15">
                                    <input type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Metronic->portletEnd(); ?>
                </div>
                <div class="col-xs-12">
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                        <strong><?php echo __d('public', 'Dokument został zapisany na liście dokumentów związanych z leadem Mój lead') ?>!</strong> <br /> <?php echo __d('public', 'Opcjonalnie możesz wykorzystać link do briefa') ?>: <br />
                        <a class="alert-link" href="">
                            <?php echo __d('public', 'Kliknij aby otworzyć brief') ?>
                        </a>
                    </div>
                    <div class="clearfix">
                        <a class="btn btn-sm yellow margin-bottom pull-right ml" href="#"><?php echo __d('public', 'Zapisz i powiadom klienta') ?></a>
                        <a class="btn btn-sm green-haze btn-sm margin-bottom pull-right poitnier"><?php echo __d('public', 'Zapisz') ?></a>
                    </div>
                </div>
            </div>
            <?php echo $this->Metronic->portletEnd(); ?>
        </div>

    </div>
</div>