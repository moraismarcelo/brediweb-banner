<?php
namespace Bredi\BrediBanner\Repository;


use Bredi\BrediDashboard\Repository\BaseRepository;
use Illuminate\Support\Facades\Input;
use \Bredi\BrediBanner\Models\Banner;

class BannerRepository extends BaseRepository
{
    protected $modelClass = \Bredi\BrediBanner\Models\Banner::class;

    public function getBannersAtivos($args = [])
    {
        $input = array_merge(Input::all(), $args);

        return $this->modelClass::where('banners.ativo', 1)->filter($input);
    }
}
