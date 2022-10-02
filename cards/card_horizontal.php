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
$images->image_intro_alt || $images->image_intro_alt_empty ? $alt = "alt=\"$images->image_intro_alt\"" : '';

?>
<div class="card <?php echo ($params->get('card_class_h')); ?>">
	<div class="row p-0">
		<?php if ($params->get('show_intro_image')) : ?>
			<div class="col-md-5 pe-0">
				<?php if (!empty($images->image_intro)) : ?>
					<?php if ($params->get('link_intro_image')) : ?>
						<a href="<?php echo $link; ?>" itemprop="url">
							<img class="<?php echo ($params->get('image_class_h')); ?>" src="<?php echo $images->image_intro; ?>" <?php echo $alt; ?>>
						</a>
					<?php else : ?>
						<img class="<?php echo ($params->get('image_class_h')); ?>" src="<?php echo $images->image_intro; ?>" <?php echo $alt; ?>>
					<?php endif; ?>
				<?php else : ?>
					<div class="bg-light <?php echo ($params->get('image_class_h')); ?>"></div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<?php ($params->get('show_intro_image')) ? $col = 'col-md-7' : $col = 'col-md-12'; ?>
		<div class="<?php echo $col; ?>">
			<div class="card-body text-center">
				<?php if ($params->get('show_title')) : ?>
					<h3 class="card-title <?php echo ($params->get('title_class_h')); ?>">
						<?php if ($params->get('link_titles')) : ?>
							<a href="<?php echo $link; ?>" itemprop="url">
								<?php echo $this->escape($this->item->title); ?>
							</a>
						<?php else : ?>
							<?php echo $this->escape($this->item->title); ?>
						<?php endif; ?>
					</h3>
				<?php endif; ?>
				<?php if ($params->get('show_intro')) : ?>
					<?php echo $this->item->introtext; ?>
				<?php endif; ?>
				<?php if ($params->get('show_link')) : ?>
					<a class="<?php echo ($params->get('link_class_h')); ?>" href="<?php echo $link; ?>" aria-label="<?php echo $this->escape($linktext . ' ' . $this->item->title); ?>">
						<?php echo $linktext; ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
