import { EditorState, basicSetup } from "@codemirror/basic-setup";
import {EditorView, keymap} from "@codemirror/view";
import { indentWithTab } from "@codemirror/commands";


// import { javascript } from "@codemirror/lang-javascript";
// import { json } from "@codemirror/lang-json";
// import { php } from "@codemirror/lang-php";
import { css } from "@codemirror/lang-css";
import {html, htmlLanguage} from "@codemirror/lang-html";
import {autocompletion} from "@codemirror/autocomplete";

import {materialDarkTheme} from './material-dark';
import {materialLightTheme} from './material-light';


/**
 *
 * @param {import("@codemirror/autocomplete").Completion} items
 * @returns {(function(*): (null|{options: [{label: string, type: string},{label: string, type: string, info: string},{apply: string, label: string, detail: string, type: string}], from: *}))|*}
 */
function myVariableCompletions(items) {
    /**
     *
     * @param {CompletionContext} context
     * @returns {{options: [{label: string, type: string},{label: string, type: string, info: string},{apply: string, label: string, detail: string, type: string}], from: number | *}|null}
     */
    return function(context) {
        let word = context.matchBefore(/\{{2}\w*/)
        if (word === null || word.from == word.to && !context.explicit)
            return null
        return {
            from: word.from + 2,
            options: [
                {label: "match", type: "keyword"},
                {label: "hello", type: "variable", info: "(World)"},
                {label: "magic", type: "text", apply: "⠁⭒*.✩.*⭒⠁", detail: "macro"},
                ...items
            ]
        }
    }
}


export default (Alpine) => {

    Alpine.data('codeEditorFormComponent', ({
        state,
        theme,
        autocomplete_variables,
    }) => {
        return {
            state,
            theme,
            autocomplete_variables,
            init: function () {
                this.render();
            },
            render() {
                this.editor = null

                this.editor = new EditorView({
                    state: EditorState.create({
                        extensions: [
                            basicSetup,
                            keymap.of([indentWithTab]),
                            // javascript(),
                            // php(),
                            // json(),
                            // css(),
                            EditorView.lineWrapping,
                            theme === 'materialDark' ? materialDarkTheme : materialLightTheme,
                            html(),
                            autocompletion({
                               activateOnTyping: true,
                                override: [myVariableCompletions(autocomplete_variables)],
                            }),
                            // htmlLanguage.data.of({
                            //     autocomplete: myCompletions
                            // }),
                            EditorView.updateListener.of((v) => {
                                if (v.docChanged) {
                                    this.state = v.state.doc.toString();
                                }
                            }),

                        ],
                        doc: this.state,
                    }),
                    parent: this.$refs.codeeditor,
                })

            },
        }
    });
}
