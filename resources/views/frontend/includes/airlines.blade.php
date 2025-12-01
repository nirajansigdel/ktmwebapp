



    <h2 class="text-center section_title">Airlines</h2>
<div class="slider">
    @foreach ($airlinesPosts as $collab)
        
   
    <div class="item"><a href=""><img alt="logo" src="{{ asset('uploads/post/' . $collab->image) }}"></a></div>
    @endforeach
</div>

<style>
    
.slider {
	display: flex;
	width: 100%;
	margin: 0 auto;
	overflow: hidden;
	padding: 2.5rem;
}
.item {
	animation: animate 25s linear infinite;
}
.item img
	{
        min-height: 80px;
        max-height: 100px;
        min-width: 200px;
        max-width: 250px;
		padding: 0 30px;
	}
.slider:hover .item {
	animation-play-state: paused;
}
@keyframes animate {
	0% {
		transform: translate3d(0, 0, 0);
	}
	100% {
		transform: translate3d(-1800px, 0, 0);
	}
}
</style>