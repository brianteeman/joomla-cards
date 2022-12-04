<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2022 Brian Teeman <https://www.learnjoomla4.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$params   = $this->item->params;
$link     = Route::_(RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
$linktext = $params->get('link_text');
$images   = json_decode($this->item->images);
(!empty($images->image_intro_alt)) || (!empty($images->image_intro_alt_empty)) ? $alt = "alt=\"$images->image_intro_alt\"" : $alt='';

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wa->addInlineStyle('.mt-n4 {margin-top: -1.5rem}');

?>
<div class="card <?php echo ($params->get('card_class_p')); ?>">
	<?php if ($params->get('show_intro_image')) : ?>
		<?php if (!empty($images->image_intro)) : ?>
			<?php if ($params->get('link_intro_image')) : ?>
				<a href="<?php echo $link; ?>" itemprop="url">
					<img class="<?php echo ($params->get('image_class_p')); ?>" src="<?php echo $images->image_intro; ?>" <?php echo $alt; ?>>
				</a>
			<?php else : ?>
				<img class="<?php echo ($params->get('image_class_p')); ?>" src="<?php echo $images->image_intro; ?>" <?php echo $alt; ?>>
			<?php endif; ?>
		<?php else : ?>
			<div class="bg-light h-100 <?php echo ($params->get('image_class_p')); ?>"></div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($params->get('show_title')) : ?>
		<h3 class="card-title position-relative <?php echo ($params->get('title_class_p')); ?>">
			<?php if ($params->get('link_titles')) : ?>
				<a href="<?php echo $link; ?>" itemprop="url">
					<?php echo $this->escape($this->item->title); ?>
				</a>
			<?php else : ?>
				<?php echo $this->escape($this->item->title); ?>
			<?php endif; ?>
		</h3>
	<?php endif; ?>
</div>

