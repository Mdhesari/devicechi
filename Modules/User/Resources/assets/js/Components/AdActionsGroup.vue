<template>
    <div class="actions-navbar">
        <b-button-group>
            <b-button class="btn-save">
                <span class="label">
                    {{ __("ads.actions.save") }}
                </span>
                <b-icon class="vertical-middle" icon="check-circle"></b-icon>
            </b-button>
            <b-button class="btn-delete">
                <span class="label">
                    {{ __("ads.actions.delete") }}
                </span>
                <b-icon class="vertical-middle" icon="trash-fill"></b-icon>
            </b-button>
            <b-button class="btn-archive">
                <span class="label">
                    {{ __("ads.actions.archive") }}
                </span>
                <b-icon class="vertical-middle" icon="pencil-square"></b-icon>
            </b-button>
            <b-button class="btn-back">
                <span class="label">
                    {{ __("ads.actions.back") }}
                </span>
                <b-icon class="vertical-middle" icon="arrow-left"></b-icon>
            </b-button>
        </b-button-group>
    </div>
</template>

<script>
export default {};
</script>
