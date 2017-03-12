-- Database generated with pgModeler (PostgreSQL Database Modeler).
-- pgModeler  version: 0.8.2
-- PostgreSQL version: 9.5
-- Project Site: pgmodeler.com.br
-- Model Author: ---

-- object: avoinhallinto | type: SCHEMA --
-- DROP SCHEMA IF EXISTS avoinhallinto CASCADE;
CREATE SCHEMA avoinhallinto;
-- ddl-end --

SET search_path TO pg_catalog,public,avoinhallinto;
-- ddl-end --

-- object: avoinhallinto.person | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.person CASCADE;
CREATE TABLE avoinhallinto.person(
	person_id serial NOT NULL,
	person_name varchar(128) NOT NULL,
	person_email varchar(128) NOT NULL,
	person_password varchar(128) NOT NULL,
	phone varchar(128),
	CONSTRAINT person_id PRIMARY KEY (person_id)

);
-- ddl-end --

-- object: avoinhallinto.person_has_role_in_group | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.person_has_role_in_group CASCADE;
CREATE TABLE avoinhallinto.person_has_role_in_group(
	role_type integer NOT NULL,
	person_id integer,
	group_id integer

);
-- ddl-end --

-- object: avoinhallinto.organization_group | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.organization_group CASCADE;
CREATE TABLE avoinhallinto.organization_group(
	group_id serial NOT NULL,
	group_name varchar(128),
	orgranization_id integer,
	CONSTRAINT group_id PRIMARY KEY (group_id)

);
-- ddl-end --

-- object: avoinhallinto.organization | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.organization CASCADE;
CREATE TABLE avoinhallinto.organization(
	organization_id serial NOT NULL,
	organization_name varchar(128),
	address varchar(128),
	CONSTRAINT organization_id PRIMARY KEY (organization_id)

);
-- ddl-end --

-- object: avoinhallinto.group_role | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.group_role CASCADE;
CREATE TABLE avoinhallinto.group_role(
	role_id serial NOT NULL,
	role_name varchar(128),
	CONSTRAINT role_id PRIMARY KEY (role_id)

);
-- ddl-end --

-- object: avoinhallinto.meeting | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.meeting CASCADE;
CREATE TABLE avoinhallinto.meeting(
	meeting_id serial NOT NULL,
	start_time time,
	endtime time,
	group_id smallint,
	visiblity smallint,
	CONSTRAINT meeting_id PRIMARY KEY (meeting_id)

);
-- ddl-end --

-- object: avoinhallinto.meeting_has_persons | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.meeting_has_persons CASCADE;
CREATE TABLE avoinhallinto.meeting_has_persons(
	person_id integer,
	meeting_id smallint,
	role_in_meeting smallint

);
-- ddl-end --

-- object: avoinhallinto."case" | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto."case" CASCADE;
CREATE TABLE avoinhallinto."case"(
	case_id serial NOT NULL,
	description varchar(1024),
	status smallint,
	visibility smallint,
	CONSTRAINT case_id PRIMARY KEY (case_id)

);
-- ddl-end --

-- object: avoinhallinto.meeting_has_case | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.meeting_has_case CASCADE;
CREATE TABLE avoinhallinto.meeting_has_case(
	case_id integer,
	meeting_id integer

);
-- ddl-end --

-- object: avoinhallinto.case_status | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.case_status CASCADE;
CREATE TABLE avoinhallinto.case_status(
	status_id serial NOT NULL,
	status_name varchar(128),
	CONSTRAINT status_id PRIMARY KEY (status_id)

);
-- ddl-end --

-- object: avoinhallinto.case_queue | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.case_queue CASCADE;
CREATE TABLE avoinhallinto.case_queue(
	queue_id serial NOT NULL,
	case_id smallint,
	group_id smallint,
	status_id smallint,
	CONSTRAINT queue_id PRIMARY KEY (queue_id)

);
-- ddl-end --

-- object: avoinhallinto.meeting_has_invitees | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.meeting_has_invitees CASCADE;
CREATE TABLE avoinhallinto.meeting_has_invitees(
	meeting_id smallint,
	person_id smallint

);
-- ddl-end --

-- object: avoinhallinto.meeting_roles | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.meeting_roles CASCADE;
CREATE TABLE avoinhallinto.meeting_roles(
	meeting_role_id serial NOT NULL,
	description varchar(128),
	CONSTRAINT meeting_role_id PRIMARY KEY (meeting_role_id)

);
-- ddl-end --

-- object: avoinhallinto.person_has_role_in_organization | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.person_has_role_in_organization CASCADE;
CREATE TABLE avoinhallinto.person_has_role_in_organization(
	persion_id smallint,
	organization_id smallint,
	organization_role_id smallint

);
-- ddl-end --

-- object: avoinhallinto.organization_role | type: TABLE --
-- DROP TABLE IF EXISTS avoinhallinto.organization_role CASCADE;
CREATE TABLE avoinhallinto.organization_role(
	role_id serial NOT NULL,
	description varchar(128),
	CONSTRAINT ogranization_role_id PRIMARY KEY (role_id)

);
-- ddl-end --

-- object: person_id | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_group DROP CONSTRAINT IF EXISTS person_id CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_group ADD CONSTRAINT person_id FOREIGN KEY (person_id)
REFERENCES avoinhallinto.person (person_id) MATCH FULL
ON DELETE CASCADE ON UPDATE NO ACTION;
-- ddl-end --

-- object: group_id | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_group DROP CONSTRAINT IF EXISTS group_id CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_group ADD CONSTRAINT group_id FOREIGN KEY (group_id)
REFERENCES avoinhallinto.organization_group (group_id) MATCH FULL
ON DELETE CASCADE ON UPDATE NO ACTION;
-- ddl-end --

-- object: role_type | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_group DROP CONSTRAINT IF EXISTS role_type CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_group ADD CONSTRAINT role_type FOREIGN KEY (role_type)
REFERENCES avoinhallinto.group_role (role_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: organization_id | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.organization_group DROP CONSTRAINT IF EXISTS organization_id CASCADE;
ALTER TABLE avoinhallinto.organization_group ADD CONSTRAINT organization_id FOREIGN KEY (orgranization_id)
REFERENCES avoinhallinto.organization (organization_id) MATCH FULL
ON DELETE CASCADE ON UPDATE NO ACTION;
-- ddl-end --

-- object: belongs_to_group | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting DROP CONSTRAINT IF EXISTS belongs_to_group CASCADE;
ALTER TABLE avoinhallinto.meeting ADD CONSTRAINT belongs_to_group FOREIGN KEY (group_id)
REFERENCES avoinhallinto.organization_group (group_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: person_in_meeting | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_persons DROP CONSTRAINT IF EXISTS person_in_meeting CASCADE;
ALTER TABLE avoinhallinto.meeting_has_persons ADD CONSTRAINT person_in_meeting FOREIGN KEY (person_id)
REFERENCES avoinhallinto.person (person_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: meeting | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_persons DROP CONSTRAINT IF EXISTS meeting CASCADE;
ALTER TABLE avoinhallinto.meeting_has_persons ADD CONSTRAINT meeting FOREIGN KEY (meeting_id)
REFERENCES avoinhallinto.meeting (meeting_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: role_in_meeting | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_persons DROP CONSTRAINT IF EXISTS role_in_meeting CASCADE;
ALTER TABLE avoinhallinto.meeting_has_persons ADD CONSTRAINT role_in_meeting FOREIGN KEY (role_in_meeting)
REFERENCES avoinhallinto.meeting_roles (meeting_role_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: status | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto."case" DROP CONSTRAINT IF EXISTS status CASCADE;
ALTER TABLE avoinhallinto."case" ADD CONSTRAINT status FOREIGN KEY (status)
REFERENCES avoinhallinto.case_status (status_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: "case" | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_case DROP CONSTRAINT IF EXISTS "case" CASCADE;
ALTER TABLE avoinhallinto.meeting_has_case ADD CONSTRAINT "case" FOREIGN KEY (case_id)
REFERENCES avoinhallinto."case" (case_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: meeting | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_case DROP CONSTRAINT IF EXISTS meeting CASCADE;
ALTER TABLE avoinhallinto.meeting_has_case ADD CONSTRAINT meeting FOREIGN KEY (meeting_id)
REFERENCES avoinhallinto.meeting (meeting_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: case_in_queue | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.case_queue DROP CONSTRAINT IF EXISTS case_in_queue CASCADE;
ALTER TABLE avoinhallinto.case_queue ADD CONSTRAINT case_in_queue FOREIGN KEY (case_id)
REFERENCES avoinhallinto."case" (case_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: group_owns | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.case_queue DROP CONSTRAINT IF EXISTS group_owns CASCADE;
ALTER TABLE avoinhallinto.case_queue ADD CONSTRAINT group_owns FOREIGN KEY (group_id)
REFERENCES avoinhallinto.organization_group (group_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: status_in_group | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.case_queue DROP CONSTRAINT IF EXISTS status_in_group CASCADE;
ALTER TABLE avoinhallinto.case_queue ADD CONSTRAINT status_in_group FOREIGN KEY (status_id)
REFERENCES avoinhallinto.case_status (status_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: meeting | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_invitees DROP CONSTRAINT IF EXISTS meeting CASCADE;
ALTER TABLE avoinhallinto.meeting_has_invitees ADD CONSTRAINT meeting FOREIGN KEY (meeting_id)
REFERENCES avoinhallinto.meeting (meeting_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: is_invited | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.meeting_has_invitees DROP CONSTRAINT IF EXISTS is_invited CASCADE;
ALTER TABLE avoinhallinto.meeting_has_invitees ADD CONSTRAINT is_invited FOREIGN KEY (person_id)
REFERENCES avoinhallinto.person (person_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: person_has_role | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_organization DROP CONSTRAINT IF EXISTS person_has_role CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_organization ADD CONSTRAINT person_has_role FOREIGN KEY (persion_id)
REFERENCES avoinhallinto.person (person_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: belongs_to_ogranization | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_organization DROP CONSTRAINT IF EXISTS belongs_to_ogranization CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_organization ADD CONSTRAINT belongs_to_ogranization FOREIGN KEY (organization_id)
REFERENCES avoinhallinto.organization (organization_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --

-- object: has_role | type: CONSTRAINT --
-- ALTER TABLE avoinhallinto.person_has_role_in_organization DROP CONSTRAINT IF EXISTS has_role CASCADE;
ALTER TABLE avoinhallinto.person_has_role_in_organization ADD CONSTRAINT has_role FOREIGN KEY (organization_role_id)
REFERENCES avoinhallinto.organization_role (role_id) MATCH FULL
ON DELETE NO ACTION ON UPDATE NO ACTION;
-- ddl-end --


