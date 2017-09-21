<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<div class="menu_section active">
<ul class="nav side-menu">
  @if (! empty($menuList))
      @foreach ($menuList as $item)
      <li class="{{($item['menu_id'] == $parentMenuId) ? 'active' : ''}}"><a><i class="fa fa-home"></i> {{$item['menu_name']}} <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" style="{{($item['menu_id'] == $parentMenuId) ? 'display: block;' : ''}}">
          @if (! empty($item['children']))
          @foreach ($item['children'] as $secondItem)
          <li class="{{($secondItem['menu_route'] == $currentRoute) ? 'current-page' : ''}}"><a href="{{url('intranet/' . $secondItem['menu_route'])}}">{{$secondItem['menu_name']}}</a></li>
          @endforeach
          @endif
        </ul>
      </li>
      @endforeach
  @endif
</ul>
</div>
</div>