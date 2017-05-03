@if(isset($size))
	<ul id="navBar" class="medium-10 columns medium-centered">
		<li class="home"><a href="../../home"><span class="icon"></span><p>Home</p></a></li>
		<li class="search"><a href="../../search"><span class="icon"></span><p>Plant Directory</p></a></li>
		<li class="plot"><a href="../../plot"><span class="icon"></span><p>Garden Plotter</p></a></li>
		<li class="calendar"><a href="../../calendar"><span class="icon"></span><p>My Calendar</p></a></li>
		<li class="overview"><a href="../../overview"><span class="icon"></span><p>Garden Overview</p></a></li>
		<li class="account">
			<a href="account"  id="noLink"><span class="icon"></span><p>My Account</p></a>
			<ul class="dd">
				<li><a href="#" data-reveal-id="profilePanel" >My Profile</a></li>
				<li><a href="../logout">Logout</a></li>
			</ul>
		</li>
	</ul>
@else
<ul id="navBar" class="medium-10 columns medium-centered">
	<li class="home"><a href="../home"><span class="icon"></span><p>Home</p></a></li>
	<li class="search"><a href="../search"><span class="icon"></span><p>Plant Directory</p></a></li>
	<li class="plot"><a href="../plot"><span class="icon"></span><p>Garden Plotter</p></a></li>
	<li class="calendar"><a href="../calendar"><span class="icon"></span><p>My Calendar</p></a></li>
	<li class="overview"><a href="../overview"><span class="icon"></span><p>Garden Overview</p></a></li>
	<li class="account">
		<a href="account"  id="noLink"><span class="icon"></span><p>My Account</p></a>
		<ul class="dd">
			<li><a href="#" data-reveal-id="profilePanel" >My Profile</a></li>
			<li><a href="../logout">Logout</a></li>
		</ul>
	</li>
</ul>
@endif
