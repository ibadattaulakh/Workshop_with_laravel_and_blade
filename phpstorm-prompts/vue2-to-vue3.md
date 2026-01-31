# Vue 2 to Vue 3 Prompt

## Prompt Name
`Vue 2 To Vue 3`

## Prompt Text
```
Convert this selection from Vue 2 Options API to Vue 3 Composition API using <script setup> and TypeScript.

Requirements:
- Use <script setup lang="ts">
- Convert props to defineProps<T>() with TypeScript types
- Convert emits to defineEmits<T>() with typed emits
- Convert data() to ref() or reactive()
- Convert methods to functions
- Convert computed properties to computed()
- Use Composition API style logic
- Maintain all functionality
- Preserve component behavior exactly
- Use proper TypeScript types for all props and emits
```

## Scope
Selection or Entire File

## Example Before (Vue 2)
```vue
<script>
export default {
  props: {
    items: {
      type: Array,
      required: true
    }
  },
  emits: ['select'],
  data() {
    return {
      open: false
    }
  },
  computed: {
    filteredItems() {
      return this.items.filter(item => item.active)
    }
  },
  methods: {
    toggle() {
      this.open = !this.open
    },
    handleSelect(id) {
      this.$emit('select', id)
    }
  }
}
</script>
```

## Example After (Vue 3)
```vue
<script setup lang="ts">
import { ref, computed } from 'vue'

const props = defineProps<{
  items: Array<{ id: number; label: string; active: boolean }>
}>()

const emit = defineEmits<{
  (e: 'select', id: number): void
}>()

const open = ref(false)

const filteredItems = computed(() => {
  return props.items.filter(item => item.active)
})

function toggle() {
  open.value = !open.value
}

function handleSelect(id: number) {
  emit('select', id)
}
</script>
```

## Usage
1. Select Vue 2 component code
2. Refactor → Add Your Prompts
3. Choose "Vue 2 To Vue 3"
4. Review diff
5. Accept changes
