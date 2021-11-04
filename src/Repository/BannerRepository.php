<?php
namespace Brediweb\BrediBanner\Repository;


use Brediweb\BrediDashboard\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use \Brediweb\BrediBanner\Models\Banner;

class BannerRepository extends BaseRepository
{
    protected $modelClass = \Brediweb\BrediBanner\Models\Banner::class;

    public function getBannersAtivos($args = [])
    {
        $input = array_merge(Input::all(), $args);

        return $this->modelClass::where('banners.ativo', 1)->filter($input);
    }
}
