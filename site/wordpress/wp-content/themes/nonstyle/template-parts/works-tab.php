<div class="works_tab">
<ul>
<?php if(is_tax('works_cat', 'reinforced_earth')): ?>
<li class="current"><a href="<?php echo home_url(); ?>/works/reinforced_earth">実績</a></li>
<li><a href="<?php echo home_url(); ?>/works/reinforced_earth_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'reinforced_earth_movie')): ?>
<li><a href="<?php echo home_url(); ?>/works/reinforced_earth">実績</a></li>
<li class="current"><a href="<?php echo home_url(); ?>/works/reinforced_earth_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'drone')): ?>
<li class="long current"><a href="<?php echo home_url(); ?>/works/drone">ラインナップ</a></li>
<li class="long "><a href="<?php echo home_url(); ?>/works/drone_laser">レーザー測量</a></li>
<?php elseif(is_tax('works_cat', 'drone_laser')): ?>
<li class="long "><a href="<?php echo home_url(); ?>/works/drone">ラインナップ</a></li>
<li class="long current"><a href="<?php echo home_url(); ?>/works/drone_laser">レーザー測量</a></li>
<?php elseif(is_tax('works_cat', 'protection_from_falling_rocks')): ?>
<li class="current"><a href="<?php echo home_url(); ?>/works/protection_from_falling_rocks">実績</a></li>
<li><a href="<?php echo home_url(); ?>/works/protection_from_falling_rocks_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'protection_from_falling_rocks_movie')): ?>
<li><a href="<?php echo home_url(); ?>/works/protection_from_falling_rocks">実績</a></li>
<li class="current"><a href="<?php echo home_url(); ?>/works/protection_from_falling_rocks_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'civil_engineering')): ?>
<li class="current"><a href="<?php echo home_url(); ?>/works/civil_engineering">実績</a></li>
<li><a href="<?php echo home_url(); ?>/works/civil_engineering_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'civil_engineering_movie')): ?>
<li><a href="<?php echo home_url(); ?>/works/civil_engineering">実績</a></li>
<li class="current"><a href="<?php echo home_url(); ?>/works/civil_engineering_movie">動画</a></li>
<?php elseif(is_tax('works_cat', 'reinforced_earth_material')): ?>
<li class="long current"><a href="<?php echo home_url(); ?>/works/reinforced_earth_material">ラインナップ</a></li>
<?php endif; ?>
</ul>
</div>
