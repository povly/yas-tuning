export default {
  extends: ['stylelint-config-standard-scss'],
  plugins: ['stylelint-scss'],
  rules: {
    'scss/at-rule-no-unknown': null,
    'property-no-unknown': [
      true,
      {
        ignoreProperties: ['composes'],
      },
    ],
    'scss/dollar-variable-pattern': null,
    'scss/percent-placeholder-pattern': null,
    'scss/no-global-function-names': null,
    'selector-pseudo-element-no-unknown': null,
    'selector-pseudo-class-no-unknown': null,
    'no-descending-specificity': null,
    'selector-class-pattern': null,
    'declaration-block-no-redundant-longhand-properties': null,
    'scss/operator-no-newline-after': null,
    'no-empty-source': null,
  },
  ignoreFiles: ['node_modules/**', 'build/**', 'dist/**'],
};
