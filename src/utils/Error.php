<?php


namespace App\utils;


class Error
{
    const PASSWORD_ERROR = 'Les mots de passe ne correspondent pas.';
    const NAME_ERROR = 'Le nom d\'utilisateur ne peut être vide.';
    const EMAIL_ERROR = 'L\'adresse email n\'est pas valide.';
    const COMMENT_ERROR = 'Le commentaire ne peut être vide.';
    const NAME_LENGHT_ERROR = 'Le nom d\'utilisateur doit être compris entre 3 et 30 caractères.';
    const PASSWORD_LENGHT_ERROR = 'Le mot de passe doit contenir entre 3 et 30 caractères.';
    const EMAIL_EXIST = 'L\'email existe déjà.';
    const CONTENT_LENGHT_ERROR = 'Le contenu doit être compris entre 3 et 200 caractères.';
    const WRONG_PASSWORD = 'Mot de passe incorrect.';
    const USER_NOT_FOUND = 'Identifiant incorrect.';
    const UNKNOWN_ERROR = 'Une erreur est survenue';

    // ADMIN
    const TITLE_ERROR = 'Le titre ne peut être vide.';
    const TITLE_LENGHT_ERROR = 'Le titre doit être compris entre 3 et 200 caractères.';
    const INTRODUCTION_ERROR = 'L\'introduction ne peut être vide.';
    const INTRODUCTION_LENGHT_ERROR = 'L\' introduction doit être compris entre 3 et 200 caractères.';
    const CONTENT_ERROR = 'Le contenu ne peut être vide.';
    const CONTENT_GEANT_LENGHT_ERROR = 'Le contenu doit être compris entre 3 et 65000 caractères.';



}