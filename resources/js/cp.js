import FormListing from "./components/Listing/FormListing.vue";
import CreateForm from "./components/Publish/CreateForm.vue";

Statamic.$components.register("list-flexible-form", FormListing);
Statamic.$components.register("create-flexible-form", CreateForm);