<section class="w-full py-20">
  <div class="w-10/12 max-w-screen-lg mx-auto">
    {{ form handle="your_form_handle" }} <!-- Add or pass in the form handle here -->
      {{ if success }}
        <div class="bg-green-500 text-lg text-white py-3 px-6 rounded-md mx-1">
          {{ success }}
        </div>
      {{ else }}
      {{ if errors }}
        <div class="bg-red-500 text-lg text-white py-3 px-6 rounded-md mx-1">
          {{ errors }}
            {{ value }}<br>
          {{ /errors }}
        </div>
      {{ /if }}
      <div class="flex flex-wrap">
        {{ fields }}
          <!-- Text fieldtype -->
          {{ if type == 'text' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="py-1">
                <input 
                  type="{{ input_type }}" 
                  name="{{ handle }}" 
                  value="{{ old }}" 
                  {{ if placeholder }}placeholder="{{ placeholder }}"{{ /if }} 
                  class="w-full border border-gray-300 py-2 px-4 rounded-md" 
                  {{ if validate | contains('required') }}required{{ /if }}
                >
              </div>
              {{ if error }}
                  <p class="text-gray-500">{{ error }}</p>
              {{ /if }}
            </div>
          <!-- Textarea fieldtype -->
          {{ elseif type == 'textarea' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="py-1">
                <textarea
                  type="{{ input_type }}"
                  name="{{ handle }}"
                  value="{{ old }}"
                  {{ if placeholder }}placeholder="{{ placeholder }}"{{ /if }} 
                  class="w-full border border-gray-300 py-2 px-4 rounded-md" 
                  rows="4"
                  {{ if validate | contains('required') }}required{{ /if }}
                ></textarea>
              </div>
              {{ if error }}
                <p class="text-gray-500">{{ error }}</p>
              {{ /if }}
            </div>
          <!-- Select fieldtype -->
          {{ elseif type == 'select' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="my-1 pr-2 border border-gray-300 rounded-md">
                <select
                  name="{{ handle }}" 
                  class="w-full py-2 px-4 rounded-md" 
                  {{ if validate | contains('required') }}required{{ /if }}
                >
                  {{ if placeholder }}
                    <option value="" disabled selected>{{ placeholder }}</option>
                  {{ /if }}
                  {{ foreach:options }}
                    <option value="{{ key }}">{{ value }}</option>
                  {{ /foreach:options }}
                </select>
              </div>
              {{ if error }}
                  <p class="text-gray-500">{{ error }}</p>
              {{ /if }}
            </div>
          <!-- Checkbox fieldtype -->
          {{ elseif type == 'checkboxes' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="flex flex-col py-1">
                <div class="flex {{ if inline == true }}flex-row flex-wrap{{ else }}flex-col{{ /if }}">
                  {{ foreach:options }}
                    <div class="flex items-center my-1 mr-6">
                      <input name="{{ handle }}[]" type="checkbox" value="{{ key | trim }}" id="chk-{{ handle | trim }}-{{ key | trim }}" class="w-3 h-3 bg-gray-100 rounded border-gray-300 cursor-pointer {{ if validate|contains("required") }}js-formCheckboxRequired{{ /if }}">
                      <label for="chk-{{ handle | trim }}-{{ key | trim }}" class="ml-3 cursor-pointer h-full">{{ if value }}{{ value }}{{ else }}{{ key }}{{ /if }}</label>
                    </div>
                  {{ /foreach:options }}
                </div>
              </div>
            </div>
          {{ elseif type == 'radio' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="flex flex-col py-1">
                <div class="flex {{ if inline == true }}flex-row flex-wrap{{ else }}flex-col{{ /if }}">
                  {{ foreach:options }}
                    <div class="flex items-center my-1 mr-6">
                      <input class="h-full" id="radio-{{ handle | trim }}-{{ key | trim }}" type="radio" name="{{ handle }}" value="{{ key | trim }}" {{ if index == 0 && validate|contains("required") }}required{{ /if }}>
                      <label for="radio-{{ handle | trim }}-{{ key | trim }}" class="ml-3 cursor-pointer flex items-center justify-center">{{ if value }}{{ value }}{{ else }}{{ key }}{{ /if }}</label>
                    </div>
                  {{ /foreach:options }}
                </div>
              </div>
            </div>
          <!-- Toggle fieldtype -->
          {{ elseif type == 'toggle' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="mt-2">
                <label class="inline-flex items-center cursor-pointer py-1">
                  <input type="checkbox" name="{{ handle }}" value="true" class="sr-only peer" {{ if validate|contains("required") }}required{{ /if }}>
                  <div class="relative w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600"></div>
                  {{ if placeholder }}
                    <span class="ml-3">{{ placeholder }}</span>
                  {{ /if }}
                </label>
              </div>
            </div>
          <!-- Integer fieldtype -->
          {{ elseif type == 'integer' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="py-1">
                <input 
                  type="number" 
                  name="{{ handle }}" 
                  value="{{ old:value }}" 
                  {{ if placeholder }}placeholder="{{ placeholder }}"{{ /if }} 
                  class="w-full border border-gray-300 py-2 px-4 rounded-md" 
                  {{ if validate | contains('required') }}required{{ /if }}
                >
              </div>
              {{ if error }}
                  <p class="text-gray-500">{{ error }}</p>
              {{ /if }}
            </div>
          <!-- Assets fieldtype -->
          {{ elseif type == 'assets' }}
            <div class="p-2" style="width:{{ width }}%;">
              {{ if !hide_display }}
                <label>{{ display }}{{ if validate | contains('required') }}<span class="text-red-500 ml-0.5">*</span>{{ /if }}</label>
              {{ /if }}
              <div class="py-1">
                <input 
                  type="file" 
                  name="{{ handle }}[]" 
                  multiple="multiple"
                  class="w-full py-3 rounded-md" 
                  {{ if validate | contains('required') }}required{{ /if }}
                >
              </div>
              {{ if error }}
                  <p class="text-gray-500">{{ error }}</p>
              {{ /if }}
            </div>
          <!-- Spacer fieldtype -->
          {{ elseif type == 'spacer' }}
            <div class="p-1 my-5" style="width:{{ width }}%;">
              {{ if width == '100' }}
                <div class="w-full h-[2px] border border-gray-100"></div>
              {{ /if }}
            </div>
          {{ /if }}
        {{ /fields }}
      </div>
      <!-- Honeypot -->
      <input type="text" class="hidden" name="{{ honeypot ?? 'honeypot' }}">
      <!-- Submit -->
      <button type="submit" class="m-2 bg-blue-500 text-white py-3 px-10 mt-5 rounded-md">Submit</button>
      {{ /if }}
    {{ /form }}
  </div>
</section>