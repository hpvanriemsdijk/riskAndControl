<span class="label label-default" data-toggle="tooltip" title="Asset type: {{ App\Asset::getAssetTypeLabel($assettype) }}">
	@if($assettype == 0)
		<i class="glyphicon glyphicon-user" ></i>
	@elseif($assettype== 1)
		<i class="glyphicon glyphicon-modal-window" ></i>
	@elseif($assettype == 2)
		<i class="glyphicon glyphicon-cog" ></i>
	@elseif($assettype == 3)
		<i class="glyphicon glyphicon-home" ></i>
	@else()
		<i class="glyphicon glyphicon-hdd" ></i>
	@endif
	Asset
</span>