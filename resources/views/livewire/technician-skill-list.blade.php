<div class="flex justify-start md:flex flex-wrap mb-2" wire:poll.5000ms> @if(count($skills) > 0)
     <h2 class="text-gray-800 font-semibold ml-2 mt-2"> Technician Skills </h2>
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