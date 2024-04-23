<?php

  // Namespace
  namespace BMI\Plugin\Dashboard;

  // Exit on direct access
  if (!defined('ABSPATH')) exit;

  $debugSectionStatment = __('For more details, %s1see%s2 or %s1download%s2 the backup logs. Maybe you (or your webmaster) can fix it yourself based on those pointers? If not:','backup-backup');
  $debugSectionStatment = str_replace(
    ['%s1', '%s2', '%s3', '%s4'],
    [
      '<a href="#" id="open-log-modal" class="link">',
      '</a>',
      '<a href="#" id="download-log" class="link">',
      '</a>',
    ],
    $debugSectionStatment
  );

  $sharingLogStatment= __("%s1You'll share:%s2 Website URL, %s3backup logs%s4, our plugin logs & configuration, basic data about your site. No confidential data such as email gets shared.", 'backup-backup');
  $sharingLogStatment = str_replace(
    ['%s1','%s2','%s3','%s4'],
    [
      '<b>',
      '</b>',
      '<a href="#" class="secondary hoverable" id="backup-logs-download">',
      '</a>'
    ],
    $sharingLogStatment
  );

?>

<div class="bmi-modal" id="backup-error-modal">

  <div class="bmi-modal-wrapper no-hpad" style="max-width: 780px; max-width: min(780px, 80vw); padding-top: 25px;">
    <a href="#" class="bmi-modal-close npt">×</a>
    <div class="bmi-modal-content center">

      <div class="mm60 f30 bold black mb flex flexcenter">
        <img src="<?php echo $this->get_asset('images', 'red-cross.svg'); ?>" alt="red-cross" width="78px">
        <div class="oll"><?php _e('Restore failed','backup-backup');?></div>
      </div>

      <div class="failure-options-container">
        <div class="cf lh30">
          <div class="left mm30 f16" style="margin-bottom:20px">
            <?php _e("However, no reason to despair! Your option(s):","backup-backup"); ?>
          </div>
        </div>
          <!-- OPTION 1: Try it in a different way -->
          <div class="collapser failure-option shadow" group="failure-option">
            <div class="header f20 pointer transition flex bold">
              <span class="right-arrow"></span>
              <?php _e('Try it in a different way','backup-backup'); ?>
            </div>
            <div class="content save-action f18 flex mm30 pbl" >
                <?php _e('The plugin also offers an alternative backup method. It might be a bit slower, but it’s worth trying.', 'backup-backup');?>
              <a class="mtll btn"><?php echo __('Yes sure, please try!','backup-backup');?></a>
            </div>
          </div>

          <!-- OPTION 2: Debug it yourself -->
          <div class="collapser failure-option shadow" group="failure-option">
            <div class="header f20 pointer transition flex bold">
              <span class="right-arrow"></span>
              <?php _e('Debug it yourself','backup-backup'); ?>
            </div>
            <div class="content save-action f18 flex mm30 pbl" >
                <?php _e('Based on what we observed, the issue could be one of those:','backup-backup');?>
                <ul>
                  <li><?php _e('Your server seems to have low RAM','backup-backup');?></li>
                  <li><?php _e('(Other reason - if we have one)','backup-backup');?></li>
                  <li><?php _e('(Other reason - if we have one)','backup-backup');?></li>
                </ul>
                <?php echo $debugSectionStatment ?>
            </div>
          </div>

          <!-- OPTION 3: Ask us! -->
          <div class="collapser failure-option shadow" group="failure-option">
            <div class="header f20 pointer transition flex bold">
              <span class="right-arrow"></span>
              <?php _e('Ask us!','backup-backup'); ?>
              <span class="its-free"></span>
            </div>
            <div class="content save-action f18 flex mm30 pbl" >
                <?php _e('We’re happy to look into it for you! Please click on the button below to send us the required debug infos:','backup-backup');?>
                <a class="btn center bmi-send-troubleshooting-logs" href="#" ><?php _e('Share debug infos with BackupBliss team', 'backup-backup');?></a>
                <span class="f16"><?php echo $sharingLogStatment ?></span>
            </div>
          </div>
      </div>
    </div>
  </div>

</div>
