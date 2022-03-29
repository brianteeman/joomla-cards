<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
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

	<div class="card <?php echo ($params->get('card_class_bg')); ?>">
		<?php if ($params->get('show_intro_image')) : ?>
			<?php if (!empty($images->image_intro)) : ?>
				<img class="card-img <?php echo ($params->get('image_class_bg')); ?>" src="<?php echo $images->image_intro; ?>">
			<?php endif; ?>
		<?php endif; ?>
		<div class="d-flex-column card-img-overlay text-center text-white">
			<?php if ($params->get('show_title')) : ?>
				<h3 class="card-title <?php echo ($params->get('title_class_bg')); ?>">
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
				<a class="<?php echo ($params->get('link_class_bg')); ?>" href="<?php echo $link; ?>" aria-label="<?php echo $this->escape($linktext . ' ' . $item->title); ?>">
					<?php echo $linktext; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

