<script lang="ts">
	import HomepageNavbar from "../../components/HomepageNavbar.svelte";
	import Icon from '$lib/assets/homepage/Beluga.png';
	import SettingsGeneral from "../../components/cards/settings/SettingsGeneral.svelte";
</script>

<HomepageNavbar />


<main class="font-montserratt bg-gray-200 flex flex-col lg:flex-row lg:h-[850px]">
	<!-- main content -->
	<SettingsGeneral />
	<div class="flex-1 p-4">
		<!-- header -->
		<header class="mb-4">
			<div class="flex flex-col space-y-2 mb-4">
				<h2 class="text-2xl font-bold text-custom">ACCOUNT</h2>
				<p class="text-sm text-gray-600">Manage your account</p>
				<hr class="border-gray-300 mt-2">
			</div>
		</header>

		<!-- main content -->
		<section class="p-4 bg-gray-200 ">
			<!-- profile pic -->
			<div class="flex items-center mb-6">
				<img src="{Icon}" alt="Profile Picture" class="w-40 h-40 rounded-full object-cover mr-5" />
				<div>
					<h1 class="text-lg font-semibold mb-1 text-custom">Profile Picture</h1>
					<p class="text-sm text-gray-600 mb-2">PNG, JPG, up to 30MB</p>
					<button class="text-green-800 border-b border-green-800 hover:underline">Edit</button>
				</div>
			</div>

			<!-- details -->
			<div class="mb-6">
				<h3 class="text-lg font-semibold mb-2 text-custom">Details</h3>
				<div class="space-y-4">
					<div class="flex flex-col sm:flex-row sm:space-x-4">
						<div class="flex flex-col flex-grow">
							<label for="user-name" class="text-sm font-medium">User Name</label>
							<input type="text" id="user-name" class="border rounded-full p-3 w-full" placeholder="@van_123" />
						</div>
						<div class="flex flex-col flex-grow">
							<label for="first-name" class="text-sm font-medium">First Name</label>
							<input type="text" id="first-name" class="border rounded-full p-3 w-full" placeholder="Van" />
						</div>
						<div class="flex flex-col flex-grow">
							<label for="last-name" class="text-sm font-medium">Last Name</label>
							<input type="text" id="last-name" class="border rounded-full p-3 w-full" placeholder="Pogi" />
						</div>
					</div>
					<div class="flex flex-col sm:flex-row sm:space-x-4">
						<div class="flex flex-col flex-grow">
							<label for="email" class="text-sm font-medium">Email Address</label>
							<input type="email" id="email" class="border rounded-full p-3 w-full" placeholder="vanpogi@gmail.com" />
						</div>
						<div class="flex flex-col flex-grow">
							<label for="mobile-number" class="text-sm font-medium">Mobile Number</label>
							<input type="text" id="mobile-number" class="border rounded-full p-3 w-full" placeholder="09696969" />
						</div>
					</div>
					<div>
						<button class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Save</button>
					</div>
				</div>
			</div>

			<!-- change pass -->
			<div>
				<h3 class="text-lg font-semibold mb-2 text-custom">Change Password</h3>
				<div class="space-y-4">
					<div class="flex flex-col">
						<label for="current-password" class="text-sm font-medium">Current Password</label>
						<input type="password" id="current-password" class="border rounded-full p-3 w-full max-w-lg" placeholder="Current Password" />
					</div>
					<div class="flex flex-col">
						<label for="new-password" class="text-sm font-medium">New Password</label>
						<input type="password" id="new-password" class="border rounded-full p-3 w-full max-w-lg" placeholder="New Password" />
					</div>
					<div>
						<button class="bg-custom text-white py-2 px-4 rounded-full hover:bg-green-800">Save</button>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>
