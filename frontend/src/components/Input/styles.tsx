import styled from 'styled-components';

export const Container = styled.div`

`;

export const Label = styled.label`
    position: relative;
    margin: auto;
    width: 100%;
    max-width: 280px;
    border-radius: 3px;
    overflow: hidden;

    .label {
        position: absolute;
        top: -2px;
        left: 12px;
        font-size: 16px;
        color: rgba(0, 0, 0, 0.5);
        font-weight: 500;
        transform-origin: 0 0;
        transform: translate3d(0, 0, 0);
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .focus-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.05);
        z-index: -1;
        transform: scaleX(0);
        transform-origin: left;
    }

    input {
        -webkit-appearance: none;
        -moz-appearance: none;
            appearance: none;
        width: 100%;
        border: 0;
        font-family: inherit;
        padding: 16px 12px 0 12px;
        height: 56px;
        font-size: 16px;
        font-weight: 400;
        background: rgba(0, 0, 0, 0.02);
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.3);
        color: #000;
        transition: all 0.15s ease;
     }

    input:hover {
        background: rgba(0, 0, 0, 0.04);
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.5);
    }

    input:not(:-moz-placeholder-shown) + .label {
        color: rgba(0, 0, 0, 0.5);
        transform: translate3d(0, -12px, 0) scale(0.75);
    }

    input:not(:-ms-input-placeholder) + .label {
        color: rgba(0, 0, 0, 0.5);
        transform: translate3d(0, -12px, 0) scale(0.75);
    }

    input:not(:placeholder-shown) + .label {
        color: rgba(0, 0, 0, 0.5);
        transform: translate3d(0, -12px, 0) scale(0.75);
    }

    input:focus {
        background: rgba(0, 0, 0, 0.05);
        outline: none;
        box-shadow: inset 0 -2px 0 #0077FF;
    }

    input:focus + .label {
        color: #0077FF;
        transform: translate3d(0, -12px, 0) scale(0.75);
    }

    input:focus + .label + .focus-bg {
        transform: scaleX(1);
        transition: all 0.1s ease;
    }
`;
