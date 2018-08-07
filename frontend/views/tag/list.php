<?php
/* @var $this TagController */

use app\models\File;

//echo "<pre>" . print_r($data['recent_nodes'], true) . "</pre>";
//$this->pageTitle = Yii::$app->name;
?>

<h3>Tags Matching:</h3>
<h2 class="invert"><?php echo $data['tag']['name']; ?></h2>
<hr />


<?php foreach ($data['nodes'] as $node_data): ?>
    <?php $tnImg = File::getTnImage($node_data['id'], $node_data['type']) ?>
	<ul class="thumbnails">
		<li class="span2">
			<?php if (!empty($tnImg)): ?>
				<div class="thumbnail">
					<a href="/<?php echo $node_data['type']; ?>/<?php echo $node_data['id']; ?>">
						<img src="<?php echo $tnImg; ?>" alt="">
					</a>
				</div>
			<?php endif; ?>
		</li>

		<li class="span4">

			<?php if(isset($node_data['category'])): ?>
				<a href='/node/category/<?php echo $node_data['category_id']; ?>'>
					<?php echo $node_data['category']; ?>
				</a><br /><br />
			<?php endif; ?>

			<span class="node-info">
                Originally published <?php echo date("m/d/Y", $node_data['created']); ?>
            </span>

			<h3>
				<a href="/<?php echo $node_data['type']; ?>/<?php echo $node_data['id']; ?>">
					<?php echo $node_data['title']; ?>
				</a>
			</h3>

			<h4><?= $node_data['author']; ?></h4>

			<p><?php echo strip_tags($node_data['teaser']); ?></p>
		</li>
	</ul>
	<div class="node-divider"></div>
<?php endforeach; ?>
