<!--
  - Copyright (c) Enalean, 2020 - present. All Rights Reserved.
  -
  - This file is a part of Tuleap.
  -
  - Tuleap is free software; you can redistribute it and/or modify
  - it under the terms of the GNU General Public License as published by
  - the Free Software Foundation; either version 2 of the License, or
  - (at your option) any later version.
  -
  - Tuleap is distributed in the hope that it will be useful,
  - but WITHOUT ANY WARRANTY; without even the implied warranty of
  - MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  - GNU General Public License for more details.
  -
  - You should have received a copy of the GNU General Public License
  - along with Tuleap. If not, see <http://www.gnu.org/licenses/>.
  -
  -->

<template>
    <div class="switch-to-projects-project">
        <a v-bind:href="project.project_uri" class="switch-to-projects-project-link">
            <i class="fa fa-fw switch-to-projects-project-icon" v-bind:class="project_icon"></i>
            <span class="switch-to-projects-project-label">{{ project.project_name }}</span>
        </a>
        <a
            v-bind:href="project.project_config_uri"
            class="switch-to-projects-project-admin-icon"
            v-bind:title="admin_title"
        >
            <i class="fa fa-fw fa-cog" v-if="project.is_current_user_admin" aria-hidden="true"></i>
        </a>
    </div>
</template>

<script lang="ts">
import Vue from "vue";
import { Component, Prop } from "vue-property-decorator";
import { Project } from "../../../type";
import {
    getProjectPrivacyIcon,
    ProjectPrivacy,
} from "../../../../../project/privacy/project-privacy-helper";
import { State } from "vuex-class";
import { sprintf } from "sprintf-js";

@Component
export default class ProjectLink extends Vue {
    @Prop({ required: true })
    readonly project!: Project;

    @State
    readonly are_restricted_users_allowed!: boolean;

    goToAdmin(event: Event): void {
        event.preventDefault();

        window.location.href = this.project.project_config_uri;
    }

    get project_icon(): string {
        const privacy: ProjectPrivacy = {
            project_is_public: this.project.is_public,
            project_is_private: this.project.is_private,
            project_is_private_incl_restricted: this.project.is_private_incl_restricted,
            project_is_public_incl_restricted: this.project.is_public_incl_restricted,
            are_restricted_users_allowed: this.are_restricted_users_allowed,
            explanation_text: "",
            privacy_title: "",
        };

        return getProjectPrivacyIcon(privacy);
    }

    get admin_title(): string {
        return sprintf(
            this.$gettext("Go to project administration of %s"),
            this.project.project_name
        );
    }
}
</script>
