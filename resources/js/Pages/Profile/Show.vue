<script setup>
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
/*
defineProps({
  confirmsTwoFactorAuthentication: Boolean,
  sessions: Array,
});*/
</script>

<template>

<div>
  <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
<!--
    <div v-if="$page.props.jetstream.canUpdateProfileInformation">
        <UpdateProfileInformationForm :user="$page.props.auth.user"/>
    </div>
    <div v-if="$page.props.jetstream.canUpdatePassword">
        <UpdatePasswordForm class="mt-10 sm:mt-0"/>
    </div>
    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
            <TwoFactorAuthenticationForm
              :requires-confirmation="confirmsTwoFactorAuthentication"
              class="mt-10 sm:mt-0"
            />
        </div>
    <LogoutOtherBrowserSessionsForm :sessions="sessions" class="mt-10 sm:mt-0"/>
    -->

    <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
        <DeleteUserForm />
    </template>
  </div>
</div>
</template>
