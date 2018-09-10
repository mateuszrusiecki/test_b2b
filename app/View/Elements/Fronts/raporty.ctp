<?php /* echo $this->element('angular/date_range'); ?>
<input type="text" date-range-picker ng-model="dates"/>
<?php /**/ ?>
<?php echo $this->Metronic->portlet(__d('public', 'Raporty'), 0, 'fa  fa-pie-chart', 'green', 0); ?>
<div class="row">
    <div class="col-md-3">
        <label>Data od</label>
        <input type="text" class="form-control" readonly="readonly" date-picker="date-picker" ng-model="report.from" >
    </div>
    <div class="col-md-3">
        <label>Data do</label>
        <input type="text" class="form-control" readonly="readonly" date-picker="date-picker" ng-model="report.to" >
    </div>
    <div class="col-md-3">
        <label>Dział</label>
        <?php echo $this->Metronic->input('section_id', array('empty' => 'Wszystkie działy', 'ng-model' => 'report.s_id')); ?>
    </div>
</div>
<div class="tiles">
    <a class="tile bg-blue" target="_blank" href="/reports/profit_clients{{report.from ? ('/from:' + report.from) : ''}}{{report.to ? ('/to:' + report.to) : ''}}{{report.s_id ? ('/s_id:' + report.s_id) : ''}}.pdf">
        <div class="tile-body">
            <i class="fa fa-bar-chart"></i>
        </div>
        <div class="tile-object">
            <div class="name"><?php echo __d('public', 'zyskowności kontrahentów') ?></div>
            <div class="number">
            </div>
        </div>
    </a>
    <a class="tile bg-yellow" target="_blank" href="/reports/profit_sections{{report.from ? ('/from:' + report.from) : ''}}{{report.to ? ('/to:' + report.to) : ''}}{{report.s_id ? ('/s_id:' + report.s_id) : ''}}.pdf">
        <div class="tile-body">
            <i class="fa fa-money"></i>
        </div>
        <div class="tile-object">
            <div class="name"><?php echo __d('public', 'zyskowności działów') ?></div>

        </div>
    </a>
    <a  target="_blank" class="tile bg-red-sunglo" href="/reports/satisfaction_clients{{report.from ? ('/from:' + report.from) : ''}}{{report.to ? ('/to:' + report.to) : ''}}{{report.s_id ? ('/s_id:' + report.s_id) : ''}}.pdf">
        <div class="tile-body">
            <i class="fa fa-random"></i>
        </div>
        <div class="tile-object">
            <div class="name"><?php echo __d('public', 'zadowolenia Klientów') ?></div>

        </div>
    </a>
    <?php /** / ?>
      <div class="tile bg-blue">
      <div class="tile-body">
      <i class="fa fa-suitcase"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'CSMS') ?></div>
      <div class="number">
      </div>
      </div>
      </div>
      <div class="tile bg-grey-silver">
      <div class="tile-body">
      <i class="fa fa-tasks"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'Zadowolenie klientów') ?></div>

      </div>
      </div>
      <div class="tile bg-purple">
      <div class="tile-body">
      <i class="fa fa-road"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'CSMS') ?></div>

      </div>
      </div>
      <div class="tile bg-yellow-gold">
      <div class="tile-body">
      <i class="fa fa-signal"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'Przepływ fin. w perspektywie 3-mc.') ?></div>

      </div>
      </div>
      <div class="tile bg-blue-madison">
      <div class="tile-body">
      <i class="fa fa-star"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'Ślubowisko') ?></div>

      </div>
      </div>
      <div class="tile bg-grey-gallery">
      <div class="tile-body">
      <i class="fa fa-users"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'Pracownicy') ?></div>

      </div>
      </div>
      <div class="tile bg-green-turquoise">
      <div class="tile-body">
      <i class="fa fa-shield"></i>
      </div>
      <div class="tile-object">
      <div class="name"><?php echo __d('public', 'Przepływ fin. w perspektywie 3-mc')?>.</div>
      </div>
      </div>
      <?php /* */ ?>
</div>
<?php echo $this->Metronic->portletEnd(); ?>