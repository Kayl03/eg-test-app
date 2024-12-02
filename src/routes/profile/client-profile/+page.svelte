<script lang="ts">
  import HomepageNavbar from "../../../components/HomepageNavbar.svelte";
  import ClientProfile from "../../../components/cards/client/ClientProfile.svelte";
  import Profile1 from '$lib/assets/profile/emma.png';
  import Profile2 from '$lib/assets/profile/calvin.png';
  import Profile3 from '$lib/assets/profile/darren.png';
  import Profile4 from '$lib/assets/profile/kyle.png';
  import { writable} from 'svelte/store';
  import type {Writable} from 'svelte/store';

  // Define the type for a team member
  type TeamMember = {
    name: string;
    image: string;
  };

  // Create a store to manage team members and their editing state
  const team1Members: Writable<TeamMember[]> = writable([
    { name: 'Emma Llamas', image: Profile1 },
    { name: 'Calvin Caguin', image: Profile2 },
    { name: 'Darren Dela Cruz', image: Profile3 },
    { name: 'Kyle Umbrero', image: Profile4 },
  ]);

  const team2Members: Writable<TeamMember[]> = writable([
    { name: 'Empty', image: '' },
    { name: 'Empty', image: '' },
    { name: 'Empty', image: '' },
    { name: 'Empty', image: '' },
  ]);

  let team1Name: string = 'Wedding';
  let team2Name: string = 'Team 2';
  let isEditing: boolean = false;

  // Toggle editing mode
  function toggleEditing(): void {
    isEditing = !isEditing;
  }

  // Remove a team member
  function removeMember(team: Writable<TeamMember[]>, index: number): void {
    team.update((members: TeamMember[]) => {
      return members.filter((_, i) => i !== index);
    });
  }

  // Update the team name
  function updateTeamName(team: number, newName: string): void {
    if (team === 1) {
      team1Name = newName;
    } else {
      team2Name = newName;
    }
  }
</script>

<HomepageNavbar />

<main class="bg-gray-200">
  <div class="font-montserratt max-w-[1300px] mx-auto flex flex-col lg:flex-row gap-10">
    <!-- client profile -->
    <ClientProfile />

    <!-- my team box main section-->
    <div class="flex flex-col w-full">


      <!-- my team box -->
      <div class="w-full bg-white border-2 p-5 mt-10 rounded-lg">
        <h1 class="font-bold text-2xl mb-4 text-custom">My Team</h1>
        <div class="flex flex-col md:flex-row justify-between gap-4">
          

          <!-- Team 1 Box -->
          <div class="w-full md:w-[49%] h-auto md:h-[850px] bg-white border border-gray-300 p-4">
            <div class="flex justify-between items-center">
              {#if isEditing}
                <input
                  type="text"
                  bind:value={team1Name}
                  class="font-semibold text-lg text-custom border border-gray-300 p-1 rounded"
                />
              {:else}
                <h3 class="font-semibold text-lg text-custom">{team1Name}</h3>
              {/if}
              <button class="text-sm text-green-800 px-3 py-1 rounded hover:underline" on:click={toggleEditing}>
                {isEditing ? 'Save' : 'Edit'}
              </button>
            </div>

            <!-- dp and name -->
            <div class="flex flex-col gap-8">
              {#each $team1Members as member, index}
                <div class="flex items-center">
                  <div class="w-[70px] h-[70px] overflow-hidden rounded-full flex-shrink-0 border-2 border-custom">
                    <img src={member.image} alt={member.name} class="w-full h-full object-cover" />
                  </div>
                  <span class="ml-4">{member.name}</span>
                  {#if isEditing}
                    <button class="text-red-600 ml-4" on:click={() => removeMember(team1Members, index)}>
                      Remove
                    </button>
                  {/if}
                </div>
              {/each}
            </div>
          </div>

          <!-- Team 2 Box -->
          <div class="w-full md:w-[49%] h-auto md:h-[850px] bg-white border border-gray-300 p-4">
            <div class="flex justify-between items-center">
              {#if isEditing}
                <input
                  type="text"
                  bind:value={team2Name}
                  class="font-semibold text-lg text-custom border border-gray-300 p-1 rounded"
                />
              {:else}
                <h3 class="font-semibold text-lg text-custom">{team2Name}</h3>
              {/if}
              <button class="text-sm text-green-800 px-3 py-1 rounded hover:underline" on:click={toggleEditing}>
                {isEditing ? 'Save' : 'Edit'}
              </button>
            </div>

            <!-- dp and name empty -->
            <div class="flex flex-col gap-8">
              {#each $team2Members as member, index}
                <div class="flex items-center">
                  <div class="w-[70px] h-[70px] bg-gray-400 rounded-full flex-shrink-0"></div>
                  <span class="ml-4">{member.name}</span>
                  {#if isEditing}
                    <button class="text-red-600 ml-4" on:click={() => removeMember(team2Members, index)}>
                      Remove
                    </button>
                  {/if}
                </div>
              {/each}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
