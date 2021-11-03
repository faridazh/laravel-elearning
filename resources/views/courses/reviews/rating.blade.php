<form action="{{ route('course_review', $course->slug) }}" method="POST" class="flex flex-col place-self-center w-full max-w-xl">
    @csrf
    <div class="flex w-full justify-center items-center">
        <div x-data="
	{
		rating: 0,
		hoverRating: 0,
		ratings: [{'amount': 1}, {'amount': 2}, {'amount': 3}, {'amount': 4}, {'amount': 5}],
		rate(amount) {
			if (this.rating == amount) {
			    this.rating = 0;
			}
			else
			{
			    this.rating = amount;
			}
		}
	}
" class="flex flex-col items-center justify-center space-y-2 mx-auto mb-3">
            <div class="flex space-x-0">
                <template x-for="(star, index) in ratings" :key="index">
                    <button type="button" @click="rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
                            aria-hidden="true"
                            :title="star.label"
                            class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline p-1 w-12 m-0 cursor-pointer"
                            :class="{'text-gray-600': hoverRating >= star.amount, 'text-yellow-400': rating >= star.amount && hoverRating >= star.amount}">
                        <svg class="w-15 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </button>
                </template>
            </div>
            <input type="hidden" name="bintangUlasan" x-bind:value="rating">
            @error('bintangUlasan')
            <div class="mt-1 text-sm text-red-700">
                <div>*{{ $message }}</div>
            </div>
            @enderror
        </div>
    </div>
    <div class="mb-2">
        <textarea name="ulasanKursus" id="ulasanKursus" rows="3" class="px-3 py-2 w-full text-sm text-gray-900 border-2 border-gray-200 rounded-md transition duration-100 focus:border-indigo-400 focus:outline-none @error('ulasanKursus') border-red-400 @enderror">{{ old('ulasanKursus') }}</textarea>
        @error('ulasanKursus')
        <div class="mt-1 text-sm text-red-700">
            <div>*{{ $message }}</div>
        </div>
        @enderror
    </div>
    <div class="mb-5">
        <div class="flex justify-center items-center space-x-2">
            <input id="nameHide" name="nameHide" type="checkbox" class="h-4 w-4 appearance-none cursor-pointer text-white rounded-sm bg-white border-2 border-gray-300 transition duration-100 checked:bg-indigo-400 checked:border-indigo-400">
            <label for="nameHide" class="text-sm font-medium text-gray-700 cursor-pointer">{{ __('course.review.hidename') }}</label>
        </div>
    </div>
    <button type="submit" class="px-4 py-2 w-full text-center rounded-lg bg-indigo-500 text-white text-base font-medium ring-2 ring-transparent transition duration-300 hover:bg-indigo-600 focus:ring-indigo-300 focus:outline-none">{{ __('course.review.submit') }}</button>
</form>
<hr class="border-t-2">
