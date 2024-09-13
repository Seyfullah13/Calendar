<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen">

    <!-- Profile Section -->
    <section class="py-40 bg-gray-100 bg-opacity-50 h-screen">
        <div class="mx-auto container max-w-2xl md:w-3/4 shadow-md">
            <div class="bg-white space-y-6">
                <form id="updateForm" action="{{ route('contacts.update') }}" method="POST">
                @csrf
                    <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
                        <h2 class="md:w-1/3 mx-auto max-w-sm">Complete Contact</h2>
                        <div class="md:w-2/3 mx-auto max-w-sm space-y-5">
                            <div>
                                <label class="text-sm text-gray-400">Full name</label>
                                <div class="w-full inline-flex border">
                                    <div class="w-1/12 pt-2 bg-gray-100">
                                        <svg fill="none" class="w-6 text-gray-400 mx-auto" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="fullName" name="name" class="w-11/12 focus:outline-none focus:text-gray-600 p-2" placeholder="Charly Olivas"/>
                                </div>
                            </div>
                            <div>
                                <label class="text-sm text-gray-400">Phone number</label>
                                <div class="w-full inline-flex border">
                                    <div class="pt-2 w-1/12 bg-gray-100">
                                        <svg fill="none" class="w-6 text-gray-400 mx-auto" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="text" id="phoneNumber" name="phone" class="w-11/12 focus:outline-none focus:text-gray-600 p-2" placeholder="12341234"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="md:w-full text-center md:pl-6 flex justify-end space-x-4 p-4">
                       
                        <button type="submit" id="continueButton" class="text-white rounded-md bg-green-600 py-2 px-4 inline-flex items-center focus:outline-none">
                            Continue
                        </button>
                    </div>
                </form>

            
            </div>
        </div>
    </section>

</body>
</html>
