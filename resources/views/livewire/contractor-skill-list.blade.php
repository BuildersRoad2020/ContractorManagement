 <div class="flex justify-start md:flex flex-wrap mb-2" wire:poll.5000ms> @if(count($skills) > 0)
     <h2 class="text-gray-800 font-semibold ml-2 mt-2"> Contractor Skills </h2>
     <hr class="w-full mt-2 mb-2">

     <div class="flex flex-wrap">
         @foreach($skills as $skill)
         <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold rounded-2xl mr-1 px-4 mb-1 ">
             {{$skill->Skills->name}} </span> @endforeach
         <!-- 0 = For Review
      1 = Approved
      2 = Rejected
      3 = Expired
      4 = Expiring -->
     </div> @endif
 </div>


 <div class="flex justify-start md:flex flex-wrap mb-2"> @if(count($documents) > 0)
     <h2 class="text-gray-800 font-semibold ml-2 mt-2"> Contractor Documents </h2>
     <hr class="w-full mt-2 mb-2">

     <div class="grid md:grid-cols-3 text-sm"> @foreach ($documents as $id)
         <div class="grid grid-cols-1">
             <div class="mx-3 text-sm font-bold "> {{$id->Documents->name}} </div>
             <div class="mx-3 text-xs mt-1">{{ucwords($id->Documents->documents_category->name)}}</div>
             <div class="mx-3 text-xs mt-1">

                 @if($id->status == 0)
                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                     For Review </span>
                 @endif

                 @if($id->status == 1)
                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                     Approved </span> @endif

                 @if($id->status == 2)
                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                     Rejected </span> @endif

                 @if($id->status == 3)
                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                     Expired </span> @endif

                 @if($id->status == 4)
                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-gray-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                     Expiring </span> @endif


             </div>

         </div>@endforeach
     </div> @endif

 </div>

 <div class="flex justify-start md:flex flex-wrap mb-2"> @if(count($rates) > 0)
     <h2 class="text-gray-800 font-semibold ml-2 mt-2"> Contractor Rates </h2>
     <hr class="w-full mt-2 mb-2">

     <div class="grid md:grid-cols-3 text-sm"> @foreach ($rates as $id)
         <div class="grid grid-cols-1">
             <div class="text-gray-600 text-sm font-bold" title="First Hour">
                 <div class="flex no-wrap">
                     {{$id->rate }} {{$id->Contractors->ContractorDetails->currency }}
               
                 </div>
             </div>

             @if($id->rate2 != null)
             <div class="text-gray-500 text-xs" title="Subsequent">
                 <div class="flex no-wrap">
                     {{$id->rate2 }} {{$id->Contractors->ContractorDetails->currency }}
                     <svg class="h-3 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                 </div>
             </div>
             @endif

             <div class="text-gray-500 text-xs">
                 <p class="text-xs">@if($id->Cities != null) {{ucfirst($id->Cities->name)}} @endif {{$id->States->name}}, {{$id->Countries->name}} </p>
             </div>
         </div> @endforeach
     </div> @endif

 </div>