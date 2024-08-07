<template>
  <div class="flexible-forms max-w-lg mt-4 mx-auto">
    <div class="rounded p-6 lg:px-20 lg:py-10 shadow bg-white">
      <header class="text-center mb-16">
        <h1 class="mb-6">{{ __('Create Flexible Form') }}</h1>
        <p class="text-gray" v-text="__('Flexible Forms are used to collect information from visitors and dispatch events and notifications when there are new submissions.')" />
      </header>
      <div class="mb-10"> 
        <label class="font-bold text-base mb-1" for="name">{{ __('Title') }}</label>
        <input type="text" v-model="title" class="input-text" autofocus tabindex="1">
        <div class="text-2xs text-gray-600 mt-2 flex items-center">
            {{ __('messages.form_configure_title_instructions') }}
        </div>
      </div>
      <div class="mb-4">
        <label class="font-bold text-base mb-1" for="name">{{ __('Handle') }}</label>
        <input type="text" v-model="handle" class="input-text" tabindex="2">
        <div class="text-2xs text-gray-600 mt-2 flex items-center">
            {{ __('messages.form_configure_handle_instructions') }}
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-8">
    <button tabindex="4" class="btn-primary mx-auto btn-lg" :disabled="! canSubmit" @click="submit">
      {{ __('Create Flexible Form')}}
    </button>
    </div>
  </div>
</template>

<script>

  export default {

    props: {
      route: {
        type: String
      }
    },
    data() {
      return {
        title: null,
        handle: null,
      }
    },
    mounted() {
      this.$keys.bindGlobal(['return'], e => {
        if (this.canSubmit) {
          this.submit();
        }
      });
    },
    watch: {
      'title': function(val) {
        this.handle = this.$slugify(val, '_');
      }
    },
    computed: {
      canSubmit() {
        return Boolean(this.title && this.handle);
      },
    },
    methods: {
      submit() {
        this.$axios.post('/cp/flexible-forms/create', {title: this.title, handle: this.handle}).then(response => {
          window.location = response.data.redirect;
        }).catch(error => {
          this.$toast.error(error.response.data.message);
        });
      }
    }
  }

</script>