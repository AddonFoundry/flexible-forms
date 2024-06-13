<template>

<stack name="inline-editor" v-if="!isEditing" @closed="editorClosed()" half>

  <div class="h-full bg-gray-300 dark:bg-dark-800 overflow-scroll">

    <publish-container
        ref="container"
        name="base"
        :blueprint="blueprint"
        :meta="meta"
        v-model="values"
        v-slot="{ setFieldValue, setFieldMeta }"
    >
        <div>
            <div>
                <h1>My Form</h1>
                <button @click="submit">Submit</button>
            </div>
 
            <publish-sections
                :section="blueprint.tabs[1].sections"
                @updated="setFieldValue"
                @meta-updated="setFieldMeta" />
        </div>
    </publish-container>

    </div>

  </stack>

</template>
<script>
export default {
  props: ['blueprint', 'values', 'meta'],

  data() {
      return {        
        //pendingCreatedField: {"handle":"first_name","type":"inline","config":{"type":"text","display":"First name","width":50,"localizable":false},"fieldtype":"text","icon":"text","_id":"main-0-0"},
      }
  },
  created() {
    console.log(this.values);
  }
}
</script>