import React from 'react';
import {render, unmountComponentAtNode} from 'react-dom';
import Welcome from './Welcome';
import {act} from "react-dom/test-utils";

let container;

beforeEach(() => {
    container = document.createElement("div");
    document.body.appendChild(container);
});

afterEach(() => {
    unmountComponentAtNode(container);
    container.remove();
    container = null;
});

describe('Welcome', () => {
    it('renders without crashing', () => {
        expect(true).toEqual(true);

        act(() => {
            render(<Welcome/>, container);
        })
    })
});
